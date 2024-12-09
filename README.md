# zonzamas.lan

------- Seleccionar alumnos ------------

SELECT nombre,apellido_1,apellido_2,nif 
FROM personas p, alumnos p2
WHERE p.id = a.id_persona;

------ Seleccionar profesores ----------

SELECT nombre,apellido_1,apellido_2,nif 
FROM personas p, profesores p2
WHERE p.id = p2.id_persona;

