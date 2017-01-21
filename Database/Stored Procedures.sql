CREATE PROCEDURE sp_getOrgs(IN status CHAR(20))
  BEGIN
    SELECT O.id_Organization,O.name,O.status, C.name AS country FROM organizations AS O inner join country AS C on O.id_Country = C.id_Country
    WHERE O.status=status;
  END;

CREATE PROCEDURE sp_getClients(IN status CHAR(20))
  BEGIN
    SELECT O.name,O.email, O.status, C.name AS country FROM clients AS O inner join country AS C
        on O.id_Country = C.id_Country
    WHERE O.status=status;
  END;

CREATE PROCEDURE sp_validateUser(IN user CHAR(20),IN pass CHAR(255))
  BEGIN
    SELECT u.idUser, u.username FROM users AS u
    WHERE u.username=user AND u.password=pass;
  END;

CREATE PROCEDURE sp_getClient(IN name1 CHAR(20),IN email1 CHAR(255))
  BEGIN
    SELECT O.name,O.email, O.status, C.name AS country FROM clients AS O inner join country AS C
        on O.id_Country = C.id_Country
    WHERE O.name=name1 OR O.email=email1;
  END;

CREATE PROCEDURE sp_getClientsStats(IN status CHAR(20))
  BEGIN
    SELECT COUNT(O.id_Client) as total,C.name AS country FROM clients AS O inner join country AS C
        on O.id_Country = C.id_Country
    WHERE O.status=status
    GROUP BY C.name
    ORDER BY C.name ASC;
  END;

CREATE PROCEDURE sp_getClientsTotal()
  BEGIN
    SELECT
      (SELECT COUNT(O.id_Client) FROM clients AS O
      WHERE O.status='Vetted') as totalVetted,
      (SELECT COUNT(O.id_Client) FROM clients AS O
      WHERE O.status='Not Vetted') as totalNotVetted;
  END;

CREATE PROCEDURE sp_getOrgsTotal()
  BEGIN
    SELECT
      (SELECT COUNT(O.id_Organization) FROM organizations AS O
      WHERE O.status='Vetted') as totalVetted,
      (SELECT COUNT(O.id_Organization) FROM organizations AS O
      WHERE O.status='Not Vetted') as totalNotVetted;
  END;

CREATE PROCEDURE sp_getOrgsStats(IN status CHAR(20))
  BEGIN
    SELECT C.name AS country, COUNT(O.id_Organization) as total FROM organizations AS O inner join country AS C
        on O.id_Country = C.id_Country
    WHERE O.status=status
    GROUP BY C.name
    ORDER BY C.name ASC;
  END;