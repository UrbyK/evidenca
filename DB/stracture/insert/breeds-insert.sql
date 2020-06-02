INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Simental', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('govedo')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Limuzin', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('govedo')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Črno-bela', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('govedo')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Holštajn', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('govedo')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Rdeči Holštanj', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('govedo')));

INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Pigmejska', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('koza')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Alpina', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('Koza')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Omedlevajoča', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('koza')));

INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Merino', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('Ovca')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Hampshire', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('Ovca')));
INSERT INTO breeds(breed, fk_idanimal_types)
VALUES('Dorset', (SELECT idanimal_types FROM animal_types WHERE lower(type) LIKE lower('Ovca')));
