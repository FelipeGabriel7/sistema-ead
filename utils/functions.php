<?php

function format_date($date)
{
        $date_format = date('d-m-Y', strtotime($date));
        $date_final = str_replace("-", "/", $date_format);
        return $date_final;
}

function format_money($money)
{
        $format_money = 'R$ ' . number_format($money, 2, ',', '.');
        return $format_money;
}
function enviarArquivo($error, $size, $name, $tmp_name)
{

        include("conexao.php");

        if ($error)
                die("Falha ao enviar arquivo");

        if ($size > 2097152)
                die("Arquivo muito grande!! Max: 2MB");

        $pasta = "arquivos/";
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != 'png')
                die("Tipo de arquivo não aceito");

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($tmp_name, $path);
        if ($deu_certo) {
                $mysqli->query("INSERT INTO arquivos (nome, path) VALUES('$nomeDoArquivo', '$path')") or die($mysqli->error);
                return true;
        } else
                return false;
}

if (isset($_FILES['arquivos'])) {
        $arquivos = $_FILES['arquivos'];
        $tudo_certo = true;
        foreach ($arquivos['name'] as $index => $arq) {
                $deu_certo = enviarArquivo($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos["tmp_name"][$index]);
                if (!$deu_certo)
                        $tudo_certo = false;
        }
        if ($tudo_certo)
                echo "<p>Todos os arquivos foram enviados com sucesso!";
        else
                echo "<p>Falha ao enviar um ou mais arquivos!";
}
