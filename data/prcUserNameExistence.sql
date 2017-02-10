---| Create procedure prcCheckIfUserNameExists |---
DELIMITER $$
CREATE PROCEDURE prcCheckIfUserNameExists
(
	IN 	pUserName varchar(50),
	OUT pExistsUserName BIT(1)
)

BEGIN
	SET pExistsUserName = 0;
	
	SELECT `Username` 
	FROM `users`
	WHERE Username = pUserName;
	
	IF (ROW_COUNT() > 0)
		THEN SET pExistsUserName = 1;
	END IF;
	
END$$
DELIMITER ;