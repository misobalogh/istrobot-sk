-- Zoznam prihlásených robotov podľa kategórii + ROK
SELECT
    c.name_SK AS category_name,
    r.name AS robot_name,
    CONCAT(u.first_name, ' ', u.last_name) AS robot_owner
FROM
    participations p
JOIN
    robots r ON p.robot_id = r.id
JOIN
    categories c ON p.category_id = c.id
JOIN
    users u ON r.user_id = u.id
JOIN
    competitions comp ON p.competition_id = comp.id
WHERE
    comp.year = 2020;