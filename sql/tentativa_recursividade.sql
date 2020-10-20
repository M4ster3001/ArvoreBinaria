WITH RECURSIVE soma (
    cod_usuario_primario,
    cod_usuario_secundario,
    paths
) AS (
    SELECT
        cod_usuario as cod_usuario_primario,
		0 as cod_usuario_secundario,
		cod_usuario as paths
    FROM tb_usuarios
    WHERE cod_usuario = 1
    UNION ALL
    SELECT
		ind.cod_usuario_primario,
		ind.cod_usuario_secundario,
		concat( s.paths, ', ', ind.cod_usuario_primario ) as paths
    FROM tb_indicacoes ind
		JOIN soma AS s
			ON ind.cod_usuario_primario = s.cod_usuario_primario
				OR ind.cod_usuario_secundario = s.cod_usuario_primario

)
SELECT * FROM soma ORDER BY cod_usuario_primario asc;