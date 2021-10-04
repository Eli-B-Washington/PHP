--Insert Iron Man:
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", '"I am the real Ironman"');

--Change Client Level:
UPDATE clients SET clientLevel = 3 WHERE clientID = 7;


--Update GM HUMMER body text:
UPDATE inventory
SET    invDescription = REPLACE(invDescription, 'small', 'spacious')
WHERE  invId = 12;


--Use inner join to select invModel from the inventory table  and classification
--name from the car classification table:
SELECT invModel, classificationName
FROM inventory 
INNER JOIN carclassification
ON inventory.classificationId = carclassification.classificationId
WHERE carclassification.classificationName = "SUV";


--delete jeep wrangler from the Jeep Wrangler from the database
DELETE FROM inventory WHERE inventory.invMake = "Jeep" AND inventory.invId = 1;

--update and add "/phpmotors to the beginning of the file path in invImage and invThumbnail"
UPDATE inventory
SET invImage = REPLACE(invImage, invImage,  CONCAT("/phpmotors", invImage)), invThumbnail = REPLACE(invThumbnail, invThumbnail, CONCAT("/phpmotors", invThumbnail));
