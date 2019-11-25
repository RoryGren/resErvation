
CREATE USER 'resWebUser'@'localhost' IDENTIFIED BY 'SomeLongConvolutedPassword';

GRANT SELECT ON * TO 'resWebUser'@'localhost';
GRANT INSERT ON * TO 'resWebUser'@'localhost';
GRANT UPDATE ON * TO 'resWebUser'@'localhost';
FLUSH PRIVILEGES;

