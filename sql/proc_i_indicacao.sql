DELIMITER $$
CREATE PROCEDURE proc_i_indicacao(in p_cod_usuario_primario int, in p_cod_usuario_secundario int)
BEGIN
	set @flg_esquerdo := (SELECT count(cod_indicacao) FROM tb_indicacoes WHERE cod_usuario_primario = p_cod_usuario_primario AND flg_esquerdo IS NOT NULL);

    INSERT INTO tb_indicacoes
		(cod_usuario_primario, cod_usuario_secundario, flg_direito, flg_esquerdo) 
    VALUE (
		p_cod_usuario_primario, p_cod_usuario_secundario,
        (
			CASE WHEN 
			@flg_esquerdo > 0
				THEN 1
                ELSE 0
			END 
        ),
        (
			CASE WHEN 
			@flg_esquerdo = 0
				THEN 1
                ELSE 0
			END 
        )
	);
END $$

DELIMITER;