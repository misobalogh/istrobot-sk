-- Author: Michal Balogh - xbalog06

------------------------------------------------------------------------------------------------------------------------

DROP TABLE "User" CASCADE CONSTRAINTS;
DROP TABLE "Admin" CASCADE CONSTRAINTS;
DROP TABLE "Robot" CASCADE CONSTRAINTS;
DROP TABLE "Country" CASCADE CONSTRAINTS;
DROP TABLE "Category" CASCADE CONSTRAINTS;
DROP TABLE "Competition" CASCADE CONSTRAINTS;
DROP TABLE "Competition_Category" CASCADE CONSTRAINTS;
DROP TABLE "Participation" CASCADE CONSTRAINTS;

DROP MATERIALIZED VIEW User_participations_count;

------------------------------------------------------------------------------------------------------------------------
-- Tables (Entities)

CREATE TABLE "Country" (
    country_code CHAR(2) PRIMARY KEY,
    name_SK VARCHAR(50) NOT NULL,
    name_EN VARCHAR(50) NOT NULL
);

CREATE TABLE "User" (
    user_id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE NOT NULL,
    school VARCHAR(50),
    city VARCHAR(100) NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- hashed password
    password_salt VARCHAR(255) NOT NULL, -- salt for password hashing
    email VARCHAR(255) NOT NULL
        CHECK(REGEXP_LIKE(
                email,  '^[[:alnum:]_\.\-]+@[[:alnum:]_\.\-]+\.[[:alpha:]]{2,4}$', 'i')),
    country_code CHAR(2) NOT NULL,
    -- user is from country
    CONSTRAINT "user_country_id_fk" FOREIGN KEY (country_code) REFERENCES "Country"(country_code)
);

CREATE TABLE "Admin" (
    admin_id INT PRIMARY KEY,
    FOREIGN KEY (admin_id) REFERENCES "User"(user_id)
);

CREATE TABLE "Robot" (
    robot_id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    coauthors VARCHAR(255),
    processor VARCHAR(50) NOT NULL,
    memory_size INT,
        CHECK (frequency > 0),
    frequency INT,
        CHECK (frequency > 0),
    sensors VARCHAR(255),
    drive VARCHAR(255),
    power_supply VARCHAR(255),
    programming_language VARCHAR(30) NOT NULL,
    interesting_facts VARCHAR(255),
    website VARCHAR(255),
    description VARCHAR2(255),
    user_id INT NOT NULL,
    -- robot constructed by user
    CONSTRAINT "robot_user_id_fk" FOREIGN KEY (user_id) REFERENCES "User"(user_id)
);

CREATE TABLE "Competition" (
    competition_id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    year INT NOT NULL
        CHECK (year BETWEEN 1000 AND 9999),
    admin_id INT NOT NULL,
    -- competition organized by admin
    CONSTRAINT "competition_admin_id_fk" FOREIGN KEY (admin_id) REFERENCES "Admin"(admin_id)
);

CREATE TABLE "Category" (
    category_id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    name_SK VARCHAR(30) NOT NULL,
    name_EN VARCHAR(30) DEFAULT NULL,
    type_of_evaluation VARCHAR(10)
        CONSTRAINT check_type CHECK (type_of_evaluation IN ('score', 'time')),
    admin_id INT NOT NULL,
    -- category created by admin
    CONSTRAINT "category_admin_id_fk" FOREIGN KEY (admin_id) REFERENCES "Admin"(admin_id)
);

CREATE TABLE "Competition_Category" (
    "category_id" INT NOT NULL,
	"competition_id" INT NOT NULL,
	CONSTRAINT "Category_Competition_PK"
		PRIMARY KEY ("category_id", "competition_id"),
	CONSTRAINT "Category_Competition_Category_FK"
		FOREIGN KEY ("category_id") REFERENCES "Category"(category_id),
	CONSTRAINT "Category_Competition_Competition_FK"
		FOREIGN KEY ("competition_id") REFERENCES "Competition"(competition_id)
);

CREATE TABLE "Participation" (
    robot_id INT,
    category_id INT,
    competition_id INT,
    start_number INT,
    result VARCHAR(10) CHECK (result IN ('MP', 'DNS') OR CAST(result AS INTEGER) >= 0), -- MP = Miss Punch, DNS = Did Not Start
    PRIMARY KEY (competition_id, robot_id, category_id),
    FOREIGN KEY (robot_id) REFERENCES "Robot"(robot_id),
    FOREIGN KEY (category_id) REFERENCES "Category"(category_id),
    FOREIGN KEY (competition_id) REFERENCES "Competition"(competition_id)
);



------------------------------------------------------------------------------------------------------------------------
-- Triggers

CREATE OR REPLACE TRIGGER hash_password_trigger
BEFORE INSERT ON "User"
FOR EACH ROW
BEGIN
    :NEW.password_salt := DBMS_RANDOM.STRING('x', 20);  -- [A-Z0-9]{20} -> 'a' [a-zA-Z0-9]
    :NEW.password_hash := DBMS_OBFUSCATION_TOOLKIT.MD5(input_string => :NEW.password_hash || :NEW.password_salt);
END;


CREATE OR REPLACE TRIGGER set_default_start_number_trigger
BEFORE INSERT ON "Participation"
FOR EACH ROW
BEGIN
    :NEW.start_number :=  0;
END;



------------------------------------------------------------------------------------------------------------------------
-- Insert sample data

INSERT INTO "Country" (country_code, name_SK, name_EN)
VALUES ('SK', 'Slovensko', 'Slovakia');
INSERT INTO "Country" (country_code, name_SK, name_EN)
VALUES ('CS', 'Ceska Republika', 'Czech Republic');
INSERT INTO "Country" (country_code, name_SK, name_EN)
VALUES ('UK', 'Anglicko', 'Great Britain');

INSERT INTO "User" (first_name, last_name, birth_date, school, city, password_hash, password_salt, email, country_code)
VALUES ('John', 'Doe', TO_DATE('2000-08-11', 'yyyy/mm/dd'), 'VUT-FEKT', 'Brno', 'StrongPWD122', 'a12mida', 'john@stud.fekt.vutbr.cz', 'CS');
INSERT INTO "User" (first_name, last_name, birth_date, school, city, password_hash, password_salt, email, country_code)
VALUES ('Jane', 'Smith', TO_DATE('1997-10-29', 'yyyy/mm/dd'), 'STU-FEI', 'Bratislava', '123', '18dso2a', 'jane@somal.sk', 'SK');
INSERT INTO "User" (first_name, last_name, birth_date, school, city, password_hash, password_salt, email, country_code)
VALUES ('Maja', 'Vcielka', TO_DATE('1999-05-12', 'yyyy/mm/dd'), 'TUKE', 'Brno-KR Pole', 'qwerty', '9ef4h89', 'maja@tuke.sk', 'SK');
INSERT INTO "User" (first_name, last_name, birth_date, school, city, password_hash, password_salt, email, country_code)
VALUES ('Franta', 'Novak', TO_DATE('1997-10-29', 'yyyy/mm/dd'), 'AMBIS', 'Frydek Mistek', '****', '888swt5', 'santa@claus.ambis.uk', 'UK');

INSERT INTO "Admin" (admin_id)
VALUES (1); -- Only one for all

INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Destroyer', 'John', 'Tachyum 3000', 800, 4000, 'Optical', '4wd', 'Nuclear power', 'C++', 'Genius', 'http://robot.com', 'This is the best robot ever', 1);
INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Fighter', 'Doe', 'Intel Potato', 200, 2000, 'Acustic', 'rwd', 'AAA battery', 'BRAIN FUCK', 'Yes', 'http://root.ro', 'Yes', 2);
-- Same processor
INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Boiler', 'Jane Smith, Michael Schum', 'Rasbery Pi', 400, 2000, 'Thermal', 'tracks', 'Solar', 'C#', 'Beast', 'http://machine.ro', 'Winner applicant', 1);
INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Dryer', 'Lara Croft, Indiana Jones', 'Rasbery Pi', 400, 2000, NULL, 'Teleport', 'Diesel', 'C', NULL, 'http://ooot.ru', 'Im the wi-nn-er', 3);
-- Same owner
INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Mixer', 'Jan Novak', 'Bajkal', 1200, 3000, 'Thermal', 'tracks', 'Solar', 'C', 'Beast', 'http://machine.ro', 'Some interesting facts', 4);
INSERT INTO "Robot" (name, coauthors, processor, memory_size, frequency, sensors, drive, power_supply, programming_language, interesting_facts, website, description, user_id)
VALUES ('Hoover', 'Clara Loft', 'ATmega328P', 1600, 3600, 'Infrared', 'wheels', 'Electric', 'ASM', NULL, 'http://fit.ups.vut.br.cz', 'Not as interesting', 4);

INSERT INTO "Competition" (name, year, admin_id)
VALUES ('Istrobot 1991', 1991, 1);  -- ID = 1
INSERT INTO "Competition" (name, year, admin_id)
VALUES ('Istrobot 2022', 2022, 1);  -- ID = 2
INSERT INTO "Competition" (name, year, admin_id)
VALUES ('Istrobot 2023', 2023, 1);  -- ID = 3
INSERT INTO "Competition" (name, year, admin_id)
VALUES ('Istrobot 2024', 2024, 1);  -- ID = 4

INSERT INTO "Category" (name_SK, name_EN, type_of_evaluation, admin_id)
VALUES ('Stopár', 'Linefolower', 'score', 1);   -- ID = 1
INSERT INTO "Category" (name_SK, name_EN, type_of_evaluation, admin_id)
VALUES ('Myš v bludisku', 'Micromouse', 'time', 1); -- ID = 2
INSERT INTO "Category" (name_SK, name_EN, type_of_evaluation, admin_id)
VALUES ('Minisumo', 'Minisumo', 'score', 1);    -- ID = 3
INSERT INTO "Category" (name_SK, name_EN, type_of_evaluation, admin_id)
VALUES ('Volna jazda', 'Freeride', 'score', 1); -- ID = 4
INSERT INTO "Category" (name_SK, name_EN, type_of_evaluation, admin_id)
VALUES ('Sklad kecupu', 'Ketchup house', 'time', 1);-- ID = 5

INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (1,5);   -- Istrobot 1991 have category Sklad kecupu
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (2,1);   -- Istrobot 2022 have category Stopar
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (2,2);   -- Istrobot 2022 have category Mys v bludisku
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (3,2);   -- Istrobot 2023 have category Mys v bludisku
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (4,2);   -- Istrobot 2024 have category Mys v bludisku
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (4,3);   -- Istrobot 2024 have category Minisumo
INSERT INTO "Competition_Category" ("competition_id", "category_id")
VALUES (4,4);   -- Istrobot 2024 have category Volna jazda

INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (1, 2, 4, 10, 300);  -- Destroyer participating in Istrobot 2024 in Mys v bludisku category with start number 10 and result 300
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (1, 3, 4, 5, 150);   -- Destroyer participating in Istrobot 2024 in Minisumo
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (1, 3, 3, 6, 'DNS'); -- Destroyer participating in Istrobot 2023 in Minisumo and it Did Not Start
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (2, 5, 1, 6, 100);   -- Fighter participating in Istrobot 1991 in Sklad kecupu
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (2, 1, 2, 6, 200);   -- Fighter participating in Istrobot 2022 in Stopar
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (2, 2, 2, 6, 'MP');   -- Fighter participating in Istrobot 2022 in Myš v bludisku and it MissedPunching
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (2, 3, 3, 6, 300);   -- Fighter participating in Istrobot 2023 in Minisumo
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (3, 2, 4, 10, 1);  -- Boiler participating in Istrobot 2024 in Mys v bludisku category
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (3, 3, 4, 5, 2);   -- Boiler participating in Istrobot 2024 in Minisumo
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (3, 3, 3, 6, 'DNS'); -- Boiler participating in Istrobot 2023 in Minisumo and it Did Not Start
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (3, 5, 1, 6, 600);   -- Boiler participating in Istrobot 1991 in Sklad kecupu

INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (4, 1, 2, 6, 700);   -- Fighter participating in Istrobot 2022 in Stopar
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (4, 2, 2, 6, 'MP');   -- Fighter participating in Istrobot 2022 in Myš v bludisku and it MissedPunching
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (4, 3, 3, 6, 800);   -- Fighter participating in Istrobot 2023 in Minisumo

INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (5, 2, 4, 10, 300);  -- Destroyer participating in Istrobot 2024 in Mys v bludisku category
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (5, 3, 4, 5, 150);   -- Destroyer participating in Istrobot 2024 in Minisumo
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (5, 3, 3, 6, 'DNS'); -- Destroyer participating in Istrobot 2023 in Minisumo and it Did Not Start
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (5, 5, 1, 6, 100);   -- Fighter participating in Istrobot 1991 in Sklad kecupu

INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (6, 1, 2, 6, 200);   -- Fighter participating in Istrobot 2022 in Stopar
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (6, 2, 2, 6, 'MP');   -- Fighter participating in Istrobot 2022 in Myš v bludisku and it MissedPunching
INSERT INTO "Participation" (robot_id, category_id, competition_id, start_number, result)
VALUES (6, 3, 3, 6, 300);   -- Fighter participating in Istrobot 2023 in Minisumo



------------------------------------------------------------------------------------------------------------------------
-- PROCEDURES

-- Procedura, ktora vypise zoznam robotov pre dany rok, prideli im startovacie cisla a vylosuje nahodne poradie
CREATE OR REPLACE PROCEDURE assign_starting_numbers(p_year IN INT) IS
BEGIN
    FOR comp_rec IN (SELECT competition_id FROM "Competition" WHERE year = p_year) LOOP
        DECLARE
            v_counter INT := 10;
        BEGIN
            FOR robot_rec IN (SELECT DISTINCT robot_id FROM "Participation" WHERE competition_id = comp_rec.competition_id ORDER BY DBMS_RANDOM.VALUE) LOOP
                UPDATE "Participation"
                SET start_number = v_counter
                WHERE robot_id = robot_rec.robot_id
                AND competition_id = comp_rec.competition_id;
                v_counter := v_counter + 1;
            END LOOP;
        END;
    END LOOP;
    COMMIT;
END;

-- Example usage:
-- BEGIN assign_starting_numbers(2024); END;


-- Procedure print_robot_stats(RobotID), Out: RobotID, Starts, Podiums, Wins
CREATE OR REPLACE PROCEDURE print_robot_stats (RobotID IN INT) AS
CURSOR participation_cursor IS SELECT result FROM "Participation" p WHERE p.robot_id = RobotID;
-- Declare var
r_result "Participation".result%TYPE;
r_starts INT;
r_podiums INT;
r_wins INT;
r_ratio NUMBER;
BEGIN
    -- Init counts
    r_starts := 0;
    r_podiums := 0;
    r_wins := 0;
    -- Open the cursor and fetch results
    OPEN participation_cursor;

    LOOP
        FETCH participation_cursor INTO r_result;
        EXIT WHEN participation_cursor%NOTFOUND;    -- Break condition
        -- Count starts (where result is a number)
        IF r_result IS NOT NULL AND r_result <> 'DNS' THEN    -- Include MP
            r_starts := r_starts + 1;
            -- Check if the result is a win (result = 1)
            IF r_result = '1' THEN
                r_wins := r_wins + 1;
            END IF;
            -- Check if the result is a podium (1, 2, 3)
            IF r_result IN ('1', '2', '3') THEN
                r_podiums := r_podiums + 1;
            END IF;
        END IF;
    END LOOP;

    -- Close the cursor
    CLOSE participation_cursor;

    r_ratio := r_wins/r_starts*100; -- multiple 100 to show %
    -- Print data to terminal in format RobotID, Starts, Podiums, Wins
    DBMS_OUTPUT.PUT_LINE('RobotID=' || RobotID || ', Starts=' || r_starts ||', Podiums=' || r_podiums || ', Wins='|| r_wins || ', Ratio W/S=' || r_ratio || '%');

EXCEPTION WHEN ZERO_DIVIDE THEN
    DBMS_OUTPUT.PUT_LINE('There is no participation for the robot');
    -- This could be done as ...EXCEPTION WHEN NO_DATA_FOUND THEN...

END;

-- Usage example
-- BEGIN print_robot_stats(3); END;



-- view starting numbers in the table ??? TODO
SELECT robot_id, category_id, start_number, year FROM "Participation" JOIN "Competition" ON "Participation".competition_id = "Competition".competition_id WHERE "Competition".year = 2024;
-- tables



------------------------------------------------------------------------------------------------------------------------
-- PERMISSIONS

-- Set permissions on table to user
GRANT ALL ON "User" TO XHAVLI59;
GRANT ALL ON "Admin" TO XHAVLI59;
GRANT ALL ON "Robot" TO XHAVLI59;
GRANT ALL ON "Country" TO XHAVLI59;
GRANT ALL ON "Category" TO XHAVLI59;
GRANT ALL ON "Competition" TO XHAVLI59;
GRANT ALL ON "Competition_Category" TO XHAVLI59;
GRANT ALL ON "Participation" TO XHAVLI59;
-- Set permission to execute procedures
GRANT EXECUTE ON assign_starting_numbers TO XHAVLI59;
GRANT EXECUTE ON print_robot_stats TO XHAVLI59;



------------------------------------------------------------------------------------------------------------------------
-- MATERIALIZED VIEW

-- Show user_id, first_name, last_name, Participations_count DESC
CREATE MATERIALIZED VIEW User_participations_count
REFRESH ON COMMIT AS
    SELECT USER_ID, FIRST_NAME, LAST_NAME, COUNT(*) Participations_count
    FROM XHAVLI59."User" NATURAL JOIN "Robot" NATURAL JOIN "Participation"
    GROUP BY USER_ID, FIRST_NAME, LAST_NAME
    ORDER BY Participations_count DESC, FIRST_NAME, LAST_NAME;



------------------------------------------------------------------------------------------------------------------------
-- EXPLAIN PLAN

-- zoznam ucastinkov z konkretnych krajin
EXPLAIN PLAN FOR
SELECT
    c.name_SK AS country_name,
    COUNT(*) AS num_participant
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Country" c ON u.country_code = c.country_code
JOIN
    "Competition_Category" cc ON p.category_id = cc."category_id"
JOIN
    "Competition" comp ON cc."competition_id" = comp.competition_id
WHERE
    comp.year = 2024
GROUP BY
    c.name_SK
ORDER BY
    c.name_SK;

SELECT * FROM TABLE(DBMS_XPLAN.DISPLAY);


CREATE INDEX comp_year ON "Competition"(year);
EXPLAIN PLAN FOR
SELECT
    c.name_SK AS country_name,
    COUNT(*) AS num_participant
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Country" c ON u.country_code = c.country_code
JOIN
    "Competition_Category" cc ON p.category_id = cc."category_id"
JOIN
    "Competition" comp ON cc."competition_id" = comp.competition_id
WHERE
    comp.year = 2024
GROUP BY
    c.name_SK
ORDER BY
    c.name_SK;

SELECT * FROM TABLE(DBMS_XPLAN.DISPLAY);
DROP INDEX comp_year;



------------------------------------------------------------------------------------------------------------------------
-- SELECTS

-- 1. Zoznam prihlásených robotov podľa kategórii + ROK
SELECT
    c.name_SK AS category_name,
    r.name AS robot_name,
    u.first_name || ' ' || u.last_name AS robot_owner
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "Category" c ON p.category_id = c.category_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
WHERE
    comp.year = 2024;


-- 2. Ako (1) ale pre jednotlivé kategórie a s náhodne vylosovaným poradím + ROK
SELECT
    c.name_SK AS category_name,
    r.name AS robot_name,
    u.first_name || ' ' || u.last_name AS robot_owner
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "Category" c ON p.category_id = c.category_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
WHERE
    comp.year = 2024
ORDER BY
    c.name_SK, DBMS_RANDOM.VALUE;


-- 3. Zoznam mailov všetkých účastníkov daného ročníka
SELECT
    DISTINCT u.email
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Competition" c ON p.competition_id = c.competition_id
WHERE
     c.year = 2024;

-- 4. Zoznam mailov všetkých účastníkov v danom intervale ročníkov (napr. 2021-2024)
SELECT
    DISTINCT u.email
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Competition" c ON p.competition_id = c.competition_id
WHERE
    c.year BETWEEN 1994 AND 2024;


-- 5. Zoznam všetkých robotov s daným typom procesora
SELECT
    r.name AS robot_name,
    r.processor
FROM
    "Robot" r
JOIN
    "Participation" p ON r.robot_id = p.robot_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
WHERE
    comp.year = 2024
ORDER BY
    r.processor;




-- 7. Podklad pre štatistiky

-- Pocet ucastnikov dany rok
SELECT
    COUNT(DISTINCT p.robot_id) AS num_participants
FROM
    "Participation" p
JOIN
    "Competition_Category" cc ON p.category_id = cc."category_id"
JOIN
    "Competition" comp ON cc."competition_id" = comp.competition_id
WHERE
    comp.year = 2024;


-- kategória - počet účastníkov complex select with WITH and CASE
WITH tmp_entity AS (
    SELECT
        cat.name_SK AS category_name,
        p.robot_id as robot_id,
        p.result as result
    FROM
    "Category" cat
    LEFT JOIN
        "Competition_Category" cc ON cat.category_id = cc."category_id"
    LEFT JOIN
        "Participation" p ON cc."competition_id" = p.competition_id AND cc."category_id" = p.category_id
    LEFT JOIN
        "Competition" comp ON cc."competition_id" = comp.competition_id
    WHERE
        comp.year = 2022
)
SELECT
    category_name,
    COUNT(robot_id) AS participants_count,
    COALESCE(COUNT(CASE WHEN result != 'DNS' THEN robot_id END), 0) AS participants_without_DNS,
    COALESCE(COUNT(CASE WHEN result NOT IN ('DNS', 'MP') THEN robot_id END), 0) AS participants_succesful
FROM
    tmp_entity
GROUP BY
    category_name
ORDER BY
    category_name;


-- zoznam ucastinkov z konkretnych krajin
SELECT
    c.name_SK AS country_name,
    COUNT(*) AS num_participant
FROM
    "Participation" p
JOIN
    "Robot" r ON p.robot_id = r.robot_id
JOIN
    "User" u ON r.user_id = u.user_id
JOIN
    "Country" c ON u.country_code = c.country_code
JOIN
    "Competition_Category" cc ON p.category_id = cc."category_id"
JOIN
    "Competition" comp ON cc."competition_id" = comp.competition_id
WHERE
    comp.year = 2024
GROUP BY
    c.name_SK
ORDER BY
    c.name_SK;


-- zoznam ludi z FEI
SELECT
    u.first_name,
    u.last_name
FROM
    "User" u
JOIN
    "Robot" r ON u.user_id = r.user_id
JOIN
    "Participation" p ON r.robot_id = p.robot_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
WHERE
    UPPER(u.school) LIKE '%FEI%'
    AND comp.year = 2023;


-- zoznam ludi z FEI s pouzitim IN s vnorenym selectom
SELECT
    u.first_name,
    u.last_name
FROM
    "User" u
WHERE
    UPPER(u.school) LIKE '%FEI%'
    AND u.user_id IN (
        SELECT
            r.user_id
        FROM
            "Robot" r
        JOIN
            "Participation" p ON r.robot_id = p.robot_id
        JOIN
            "Competition" comp ON p.competition_id = comp.competition_id
        WHERE
            comp.year = 2023
);


-- spocitat typ procesora a kde viac ako 5 = zaujimavost do statistiky
SELECT
    r.processor,
    COUNT(*) AS processor_count
FROM
    "Robot" r
JOIN
    "Participation" p ON r.robot_id = p.robot_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
WHERE
    comp.year = 2024
GROUP BY
    r.processor
HAVING
    COUNT(*) >= 5;


-- robot veteran = viac ako 3 roky bol jeden robot na sutazi
SELECT
    r.robot_id,
    r.name AS robot_name,
    COUNT(DISTINCT comp.year) AS years_participated
FROM
    "Robot" r
JOIN
    "Participation" p ON r.robot_id = p.robot_id
JOIN
    "Competition" comp ON p.competition_id = comp.competition_id
GROUP BY
    r.robot_id, r.name
HAVING
    COUNT(DISTINCT comp.year) >= 3;
