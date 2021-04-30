<?php
require_once ("menu.php");
require_once ("constantes_" . $_SERVER ["AMBIENTE"] . ".php");
require_once ("oracle.php");
require_once ("funcoes.php");

mostraLog("MODO DEBUG HABILITADO");

set_time_limit( 0 );
ini_set ( 'max_execution_time', 600 );
error_reporting(0);
?>

<style type="text/css">
	#subir{
			position:fixed;
			left:0%;
			right: 0;
			bottom:0px;
			right:0px;
			weight:15px;
			color: #000000;
	}
</style>

<?php

// Bloqueia a execução de 2 ou mais scripts ao mesmo tempo
if (file_exists (DIRETORIO."controle_execucao_script.txt" )) {
	pr("<br/>" . "<br/>" . "<br/>" . "<br/>" . "<br/>" . "<b>Já existe um script em execução. Aguarde para tentar enviar novamente!</b>");
	throw new InfraException ("<br/>" . "<br/>" . "<br/>" . "<br/>" . "<b>Já existe um script em execução.</b>" );
} else {
	$arquivoControle = DIRETORIO.'controle_fatura_' . date ( 'd-m-Y' ) . '.txt';
	// Cria arquivo de consulta para execução ou não do script
	file_put_contents ( DIRETORIO."controle_execucao_script.txt", date ( "d/m/Y H:i:s" ) . " Arquivo de excução de script ativo. ", FILE_APPEND );
}

// Criação do arquivo de LOG de procedimento
$arquivoProcedimento = DIRETORIO."procedimento_" . date ( "d-m-Y" ) . ".txt";

// Criação do arquivo de LOG de execução
$arquivoExecucao = DIRETORIO."logExecucao_" . date ( "d-m-Y" ) . ".txt";

$strWSDL = WSDL_SEI;

if (! file_get_contents ( $strWSDL )) {
	throw new InfraException ( "Arquivo WSDL " . $strWSDL . " não encontrado." );
}

try {
	$objWS = new SoapClient ( $strWSDL, array (
			"encoding" => "ISO-8859-1",
			"exceptions" => 0,
			"trace" => 1
	) );
} catch ( Exception $e ) {
	throw new InfraException ( "Erro acessando serviço.", $e );
}

$dbh = new PDOConnection ();

$clientes = $dbh->select ( "SELECT DISTINCT FATURA,
                            NUMEROPROCESSOSEI,
                            CODIGOCLIENTE,
                            NOMECLIENTE,
                            CODIGOQUEBRA,
                            NOMEQUEBRA,
                            CODIGOCONTRATO,
                            NOMECONTRATO,
                            CODIGOVERIFICACAO,
                            CTISS,
                            DATAEMISSAO,
                            VALORLIQUIDOTOTAL,
                            DATAVENCIMENTO,
                            MESCOMPETENCIA_2105,
                            IDMOVIMENTO,
                            CODIGOUNIDADESEI,
                            NOMEUNIDADESEI,
                            STATUSSEI
                            FROM TABLE_TEST_SEI 
							ORDER BY FATURA");

if (empty($clientes)) {
	echo "<br />" . "<br />" . "<br />" . "<br />" . "<br />"  . "\n" ."<b>Não existem faturas no momento!</b> " . "\n" . "<br />";
	unlink ( DIRETORIO."controle_execucao_script.txt" );
}

if (file_exists ( $arquivoControle )) {// Verifica se o arquivo existe
	$conteudo = file_get_contents ( $arquivoControle );// 
}else {
	@touch ( $arquivoControle );// Se caso o arquivo não exista, aqui ele passa a existir
	$conteudo = file_get_contents ( $arquivoControle );
}

// Configurações do serviço
$siglaSistema = SIGLA_SISTEMA;
$idServico = ID_SERVICO;
$numeroUnidade = NUMERO_UNIDADE;

$counter = 0; //faz a contagem de faturas enviadas
$count = 0; // Para mostrar somente uma vez na tela o texto AVISOS
echo "<BR><BR><BR><BR><BR><BR>"; // espacamentos para ajuste da pagina
foreach ( $clientes as $cliente ) {

	if ( !preg_match_all ( "/^" . $cliente ["FATURA"] . "\$/m", $conteudo, $matches )) {
		
		// Separa o campos unidade sei e id unidade assinatura. Separador usado devera ser extamente "- Bloco"
		$separador = explode ( "- Bloco", $cliente ["NOMEUNIDADESEI"] );
		$nomeUnidadeSei = trim ( $separador [0] );
		$idUnidadeAssinatura = trim ( $separador [1] );
		
		$documento = array ();
		
		// Caso contrato sem preenchimento da unidade SEI. Envia por padrão para o financeiro.
		if (empty ( $cliente ["CODIGOUNIDADESEI"] )) {
			$cliente ["CODIGOUNIDADESEI"] = $numeroUnidade;
			$nomeUnidadeSei = NOME_UNIDADE_SEI;
		}
		
		// Documento
		$documento ["Tipo"] = "G"; // G = documento gerado R = documento recebido (externo)
		$retornoConsultarProcedimento = $objWS->consultarProcedimento ( $siglaSistema, $idServico, "", $cliente ["NUMEROPROCESSOSEI"] );
		if ( !empty($retornoConsultarProcedimento->IdProcedimento) ) {
			$documento ["IdProcedimento"] = $retornoConsultarProcedimento->IdProcedimento;
		}else {
			$documento ["IdProcedimento"] = '';
		}
		$documento ["IdSerie"] = ID_SERIE_FATURA; // informar o id do Tipos de Documento
		$documento ["Descricao"] = utf8_decode ( "Relatório de faturamento" );
		
		$arrInteressados = array ();
		$arrInteressados [] = array (
				"Sigla" => $cliente ["CODIGOUNIDADESEI"],
				"Nome" => $nomeUnidadeSei 
		);
		
		$documento ["Interessados"] = $arrInteressados;
		$documento ["NivelAcesso"] = 0;
		
		$htmlDocumento = "";
		
		$htmlDocumento .= '<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
				<meta name="format-detection" content="telephone=no">
				<meta name="msapplication-tap-highlight" content="no">
				<link href="https://fonts.googleapis.com/css?family=Montserrat|Rubik" rel="stylesheet">
				<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
				<title>Envio de faturas para o SEI</title>
			</head>
			<body>
				<table style="width:100%">
					<tr>
						<td>
							<b>CLIENTE: </b>' . $cliente ["CODIGOCLIENTE"] . " " . $cliente ["NOMECLIENTE"] . '
						</td>
					</tr>
					<tr>
						<td>
							<b>QUEBRA DE FATURA: </b>' . $cliente ["CODIGOQUEBRA"] . ' ' . $cliente ["NOMEQUEBRA"] . '
						</td>
					</tr>
					<tr>
						<td>
							<b>CONTRATO: </b>' . $cliente ["CODIGOCONTRATO"] . ' ' . $cliente ["NOMECONTRATO"] . '
						</td>
					</tr>
					<tr>
						<td>
							<b>FATURA: </b> ' . $cliente ["FATURA"] . '
						</td>
						<td>
							<b>COD. VERIFICAÇÃO: </b> ' . $cliente ["CODIGOVERIFICACAO"] . '
						</td>
						<td>
							<b>CTISS: </b> ' . $cliente ["CTISS"] . '
						</td>
					</tr>
					<tr>
						<td>
							<b>DATA EMISSÃO: </b> ' . $cliente ["DATAEMISSAO"] . ' 
						</td>
						<td>
							<b>VALOR: </b> ' . $cliente ["VALORLIQUIDOTOTAL"] . '
						</td>
						<td>
							<b>DATA VENCIMENTO: </b> ' . $cliente ["DATAVENCIMENTO"] . '
						</td>
					</tr>
					<tr>
						<td>
							Referência: Serviços prestados em <b>' . $cliente ["MESCOMPETENCIA_2105"] . '</b>
						</td>
					</tr>
				</table>
				<br /><br />
				<table style="width:100%">';
                
		$grupos = $dbh->select ( "SELECT DISTINCT CODIGOGRUPOPRODUTO, NOMEGRUPOPRODUTO FROM TABLE_TEST_SEI WHERE fatura = '" . $cliente ["FATURA"] . "'" );
		
		foreach ( $grupos as $grupo ) {
			$htmlDocumento .= '<thead>
				<tr>
					<th>ITEM</th>
					<th>DESCRICAO</th>
					<th>QUANTIDADE</th>
					<th>VLR. UNITARIO</th>
					<th>VLR. TOTAL</th>
					<th>VLR. APÓS DESCONTO</th>
				</tr>
			</thead>';
			
			$htmlDocumento .= "<tr>
				<td colspan='1'>
					<b>" . $grupo ["CODIGOGRUPOPRODUTO"] . "</b>
				</td>
				<td colspan='5'>
					<b>" . $grupo ["NOMEGRUPOPRODUTO"] . "</b>
				</td>
			</tr>";
			
			$itens = $dbh->select ( "SELECT CODIGOPRODUTO,
									NOMEPRODUTO,
									QUANTIDADE,
									VALORUNITARIO,
									VALORUNITARIOTOTAL,
									VALORAPOSDESCONTO,
									OBSERVACOES
									FROM TABLE_TEST_SEI
									WHERE FATURA           = '" . $cliente ["FATURA"] . "'
									AND CODIGOGRUPOPRODUTO = '" . $grupo ["CODIGOGRUPOPRODUTO"] . "'" );
			
			foreach ( $itens as $item ) {
				$htmlDocumento .= "<tr>
					<td>" . $item ["CODIGOPRODUTO"] . "</td>
					<td>" . $item ["NOMEPRODUTO"] . "</td>
					<td>" . $item ["QUANTIDADE"] . "</td>
					<td>" . $item ["VALORUNITARIO"] . "</td>
					<td>" . $item ["VALORUNITARIOTOTAL"] . "</td>
					<td>" . $item ["VALORAPOSDESCONTO"] . "</td>
				</tr>
				<tr>
					<td colspan='7'>" . $item ["OBSERVACOES"] . "</td>
				</tr>";
			}
		}
		
		$valorFinal = $dbh->select ( "SELECT DISTINCT SUBTOTAL,
									ISSTOTAL,
									TOTALBRUTO,
									VALORDESCONTOTOTAL,
									VALORLIQUIDOTOTAL
									FROM TABLE_TEST_SEI
									WHERE FATURA = '" . $cliente ["FATURA"] . "'" );
        
		$htmlDocumento .= "<tr>
						<td colspan='4'>
							<div align='right'>******** SUB-TOTAL:</div>
						</td>
						<td colspan='2'>
							<div align='right'>" . $valor ["SUBTOTAL"] . "</div>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<div align='right'>******DESCONTO:</div>
						</td>
						<td colspan='2'>
							<div align='right'>" . $valor ["VALORDESCONTOTOTAL"] . "</div>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<div align='right'>***TOTAL BRUTO:</div>
						</td>
						<td colspan='2'>
							<div align='right'>" . $valor ["TOTALBRUTO"] . "</div>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<div align='right'>ISS A SER RETIDO NA FONTE:</div>
						</td>
						<td colspan='2'>
							<div align='right'>" . $valor ["ISSTOTAL"] . "</div>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<div align='right'>*TOTAL LÍQUIDO:</div>
						</td>
						<td colspan='2'>
							<div align='right'>" . $valor ["VALORLIQUIDOTOTAL"] . "</div>
						</td>
					</tr>
				</table>
			</body>
		</html>";
		
		$documento ["Conteudo"] = base64_encode ( $htmlDocumento );
		
		$procedimento = $objWS->incluirDocumento ( $siglaSistema, $idServico, $numeroUnidade, $documento );
		
		if (is_soap_fault ( $procedimento )) {
			if(isset($cliente ["FATURA"])){
				
				$count++;
				if($count == 1){
					echo "<b>AVISOS:</b><br /> ------------------------------------------------------------- <br />";
				}
				
				$recuperaprocessosei = $dbh->select ( "SELECT DISTINCT FATURA,
									NUMEROPROCESSOSEI
									FROM TABLE_TEST_SEI
									WHERE FATURA = '" . $cliente ["FATURA"] . "'"  
									); // recupera as faturas com numero do processo do SEI que retornaram erro
				foreach ( $recuperaprocessosei as $numero_processosei ) {
					
					echo date ( "d/m/Y H:i:s" ) . " Fatura <b>" . $cliente ["FATURA"] . "</b> não enviada. Erro ao tentar adicionar ao processo <b>" . $numero_processosei["NUMEROPROCESSOSEI"] . "</b><br />" . "\n";
				}
				
								
			}		
			$idProcedimento = $retornoConsultarProcedimento->IdProcedimento;
			$processoNumero = $retornoConsultarProcedimento->ProcedimentoFormatado;
			$procedimento->faultstring = utf8_encode($procedimento->faultstring);
			$retornoConsultarProcedimento->faultstring = utf8_encode($retornoConsultarProcedimento->faultstring);

			if ($documento ["IdProcedimento"] == '' ) {
				
				$docVazio = $retornoConsultarProcedimento;
				file_put_contents ( "relatorio_erro_criacao_processo_sei.txt", date ( "d/m/Y H:i:s" ) . " - Erro na criação do documento: " . $procedimento->faultstring . " / "  . "Descrição: " . $retornoConsultarProcedimento->faultstring . "<br />" . "\n", FILE_APPEND );
			} else {
				$docErro = $procedimento;
				file_put_contents ( "relatorio_erro_criacao_processo_sei.txt", date ( "d/m/Y H:i:s" ) . " - Erro na criação do processo: " . "Procedimento ID: " . $idProcedimento . " / " . "Processo Número: " . $processoNumero . " / " . "\n" . "Descrição: " . $procedimento->faultstring . "<br />" . "\n", FILE_APPEND );
				
			}
			
		} else {
			
			$retornoConsultarProcedimento->faultstring = utf8_encode($retornoConsultarProcedimento->faultstring);

			//Consulta os atributos do bloco
			$processoBloco = $objWS->consultarBloco ( $siglaSistema, $idServico, $numeroUnidade, $idUnidadeAssinatura);
			
			if ($processoBloco->Estado <> "A") {
				$processoBloco = $objWS->cancelarDisponibilizacaoBloco ( $siglaSistema, $idServico, $numeroUnidade, $idUnidadeAssinatura);
			}
		
			// Colocar documento em um bloco de assinatura
			$processoBloco = $objWS->incluirDocumentoBloco ( $siglaSistema, $idServico, $numeroUnidade, $idUnidadeAssinatura, $procedimento->DocumentoFormatado );
			
			$processoBloco = $objWS->disponibilizarBloco ( $siglaSistema, $idServico, $numeroUnidade, $idUnidadeAssinatura);
			
			// Limpa o documento
			$htmlDocumento = "";
		
			if ($processoBloco == 1) {
				$result = "Conectou ao WebService";
			}else {
				$result = "Não conectou ao WebService";
			}
			
			//################## LOG DE EXECUÇÃO #####################################
			if ( isset( $cliente ) ) {
				$documento ["Descricao"] = utf8_encode($documento ["Descricao"]);

				if ( isset( $arquivoExecucao ) ) {
					file_put_contents ( $arquivoExecucao, 'Execução criada em: ' . date ( 'd/m/Y H:i:s' ) . "\n" . "</ br>"
					. 'Retorno WebService: ' . $result . "\n" . "</ br>"
					. 'Número do Processo Sei: ' . $cliente ["NUMEROPROCESSOSEI"] . "\n" . "</ br>"
					. 'Fatura: ' . $cliente ["FATURA"] . "\n" . "</ br>"
					. 'Número do Documento Sei: ' . $procedimento->DocumentoFormatado . "\n" . "</ br>"
					. 'ID da Sigla: ' . $siglaSistema . "\n" . "</ br>"
					. 'ID do Serviço: ' . $idServico . "\n" . "</ br>"
					. 'Número da Unidade: ' . $numeroUnidade . "\n" . "</ br>"
					. 'Unidade Assinatura: ' . $idServico . "\n" . "</ br>"
					. 'ID do Procedimento: ' . $idUnidadeAssinatura ["IdProcedimento"] . "\n" . "</ br>"
					. 'Id da Série: ' . $documento ["IdSerie"] . "\n" . "</ br>"
					. 'Descrição: ' . $documento ["Descricao"] . "\n" . "</ br>"
					. 'Sigla: ' . $documento ["Interessados"][0]['Sigla'] . "\n" . "</ br>"
					. 'Nome da UnidadeS: ' . $documento ["Interessados"][0]['Nome'] . "\n\n" . "</ br>" . "</ br>" , FILE_APPEND );
					
				}
			}
			//##########################################################################
						
			// Número processo SEI
			$numeroProcessoSei = $cliente ["NUMEROPROCESSOSEI"];
			
			$arrUnidadesDestino = array ();
			$arrUnidadesDestino [] = $cliente ["CODIGOUNIDADESEI"]; // Unidade do cliente
		
			// Enviar procedimento com a pre fatura para unidade do cliente
			$retornoEnviarProcesso = $objWS->enviarProcesso ( $siglaSistema, $idServico, $numeroUnidade, $numeroProcessoSei, $arrUnidadesDestino, "N", "", "S", "", "", "", "S" );
            
			file_put_contents ( $arquivoControle, $cliente ["FATURA"] . "\n", FILE_APPEND ); // abre o arquivo , grava a fatura, salva e fecha o arquivo
			
			
			file_put_contents ( DIRETORIO."relatorio_criacao_processo_sei.txt", date ( "d/m/Y H:i:s" ) . " Fatura <b>" . $cliente ["FATURA"] . "</b> adicionada ao processo <b>" . $numeroProcessoSei . "</b><br />" . "\n", FILE_APPEND );
			
			$conteudo = file_get_contents ( $arquivoControle );

			//################## LOG DE PROCEDIMENTO #####################################
			if ( isset( $cliente ) ) {
					
				if ( isset( $arquivoProcedimento ) ) {
					file_put_contents ( $arquivoProcedimento, 'Procedimento criado em: ' . date ( 'd/m/Y H:i:s' ) . "\n" . "</ br>"
					. 'FATURA: ' . $cliente ["FATURA"] . "\n" . "</ br>"
					. 'NUMEROPROCESSOSEI: ' . $cliente['NUMEROPROCESSOSEI'] . "\n" . "</ br>"
					. 'CODIGOCLIENTE: ' . $cliente['CODIGOCLIENTE'] . "\n" . "</ br>"
					. 'NOMECLIENTE: ' . $cliente['NOMECLIENTE'] . "\n" . "</ br>"
					. 'CODIGOQUEBRA: ' . $cliente['CODIGOQUEBRA'] . "\n" . "</ br>"
					. 'NOMEQUEBRA: ' . $cliente['NOMEQUEBRA'] . "\n" . "</ br>" 
					. 'CODIGOCONTRATO: ' . $cliente['CODIGOCONTRATO'] . "\n" . "</ br>" 
					. 'NOMECONTRATO: ' . $cliente['NOMECONTRATO'] . "\n" . "</ br>" 
					. 'CODIGOVERIFICACAO: ' . $cliente['CODIGOVERIFICACAO'] . "\n" . "</ br>"
					. 'CTISS: ' . $cliente['CTISS'] . "\n" . "</ br>" 
					. 'DATAEMISSAO: ' . $cliente['DATAEMISSAO'] . "\n" . "</ br>" 
					. 'VALORLIQUIDOTOTAL: ' . $cliente['VALORLIQUIDOTOTAL'] . "\n" . "</ br>" 
					. 'DATAVENCIMENTO: ' . $cliente['DATAVENCIMENTO'] . "\n" . "</ br>" 
					. 'MESCOMPETENCIA_2105: ' . $cliente['MESCOMPETENCIA_2105'] . "\n" . "</ br>" 
					. 'IDMOVIMENTO: ' . $cliente['IDMOVIMENTO'] . "\n" . "</ br>" 
					. 'CODIGOUNIDADESEI: ' . $cliente['CODIGOUNIDADESEI'] . "\n" . "</ br>" 
					. 'NOMEUNIDADESEI: ' . $cliente['NOMEUNIDADESEI'] . "\n\n" . "</ br>" . "</ br>" , FILE_APPEND );
				}
			}
			//##########################################################################
			$counter++;
		}
		
	}else {
		// Número processo SEI e Fatura
		$numeroProcessoSei = $cliente ["NUMEROPROCESSOSEI"];
		$existeFatura = $cliente["FATURA"];
		file_put_contents ( DIRETORIO."relatorio_criacao_processo_sei.txt", date ( "d/m/Y H:i:s" ) . " Fatura <b>" . $existeFatura . "</b> já existe no processo <b>" . $numeroProcessoSei . "</b><br />" . "\n", FILE_APPEND );
	}
	
}
	// Formatação do arquivo de LOG de execução
	$arquivoExecucao = DIRETORIO."logExecucao_" . date ( "d-m-Y" ) . ".txt";
	$arq = $arquivoExecucao;
	$fp = fopen($arq, 'r');

	//Lemos o arquivo
	$execucao = fread($fp, filesize($arq));

	//Transformamos as quebras de linha em etiquetas
	$execucao = nl2br($execucao);	

	$arquivoLogExecucao = DIRETORIO."logExecucao_" . date ( "d-m-Y" ) . ".txt";
	$executa = DIRETORIO."logExecucao_" . date ( "d-m-Y" ) . ".txt";
	$format_executa = fopen ( $executa , 'w' );
	fwrite ( $format_executa , $execucao);
	fclose ( $format_executa );

	// Formatação do arquivo de LOG de procedimento
	$arquivoProcedimento = DIRETORIO."procedimento_" . date ( "d-m-Y" ) . ".txt";
	$file = $arquivoProcedimento;
	$file_print = fopen($file, 'r');

	//Lemos o arquivo
	$procedencia = fread($file_print, filesize($file));

	//Transformamos as quebras de linha em etiquetas
	$procedencia = nl2br($procedencia);	

	$arquivoLogProcedimento = DIRETORIO."procedimento_" . date ( "d-m-Y" ) . ".txt";
	$procede = DIRETORIO."procedimento_" . date ( "d-m-Y" ) . ".txt";
	$format_procede = fopen ( $procede , 'w' );
	fwrite ( $format_procede , $procedencia);
	fclose ( $format_procede );

echo "<br />" . "\n" ."<b>Quantidade de faturas enviadas =</b> ". $counter . "\n" . "<br />";

if (file_exists ( DIRETORIO."relatorio_criacao_processo_sei.txt" )) {
	echo "<br /><b>LOG DE CRIAÇÃO:</b><br /> ------------------------------------------------------------- <br />" . file_get_contents ( DIRETORIO."relatorio_criacao_processo_sei.txt" ) . "<br />";
	unlink ( DIRETORIO."relatorio_criacao_processo_sei.txt" );
	unlink ( DIRETORIO."controle_execucao_script.txt" );
}

if (file_exists ( "relatorio_erro_criacao_processo_sei.txt" )) {
	echo "<br /><br /><b>LOG DE ERRO:</b><br /> ------------------------------------------------------------- <br />" . file_get_contents ( "relatorio_erro_criacao_processo_sei.txt" ) . "<br />";
	unlink ( "relatorio_erro_criacao_processo_sei.txt" );
	unlink ( DIRETORIO."controle_execucao_script.txt" );
	echo "<b>XML completo do erro no WebService: </b><br /> ";
	pr(date ( "d/m/Y H:i:s"));
	pr($docVazio);
	pr(date ( "d/m/Y H:i:s"));
	pr($docErro);
	pr(date ( "d/m/Y H:i:s"));
	pr($objWS);
}

if (!file_exists(DIRETORIO."controle_execucao_script.txt")) {
	deletaArquivos(DIRETORIO);
}

?>
<div id="div">
	<a href="#" id="subir"><?php require_once("footer.php");?></a>
</div>