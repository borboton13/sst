/** 26.10.2017 Aumentando celdas Form P013 **/

-- SELECT f.`id`, f.`idevento`, f.`titulo`, LENGTH(f.`p17`), SUBSTR(f.`p17`, LENGTH(f.`p17`)-50, LENGTH(f.`p17`))

UPDATE formulario_p013 f SET f.`p17` = CONCAT(f.`p17`, "|;;;;;;;;;;;;;|;;;;;;;;;;;;;|;;;;;;;;;;;;;|;;;;;;;;;;;;;|;;;;;;;;;;;;;");