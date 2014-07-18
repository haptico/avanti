        <div id="footer">
            <table border="0" width="100%">
                <tr>
                    <td width="20%" class="nome_sistema" valign=bottom align="left"> Base do BDNI Utilizada <?= $SYS_MAIOR_BDNI; ?></td>
                    <td width="60%" align="center">
                        <small>&copy; Copyright 2010 BETWEEN - Todos os direitos reservados.
                            <img alt='' border='0' class='sys_img' src='imagens/icones/modelo1/Computer_On.png' width='20' /> Tempo de Processamento: <? printf('%.5f', ((microtime(true) - $SYS_tempo_inicio) - $qry->tempo_processamento_acumulado)); ?> segs
                            <img alt='' border='0' class='sys_img' src='imagens/icones/modelo1/Vista_(229).png' width='20'  /> BD: <? printf('%.5f', $qry->tempo_processamento_acumulado); ?> segs</small>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>