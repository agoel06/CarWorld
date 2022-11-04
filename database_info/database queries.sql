CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL,
  full_name VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  gender VARCHAR(10) DEFAULT NULL,
  address VARCHAR(100) NOT NULL,
  profile_img varchar(150) DEFAULT NULL,
  PRIMARY KEY(id)
);
CREATE TABLE admin (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(500) NOT NULL,
  full_name VARCHAR(100) NOT NULL,
  profile_img VARCHAR(150) DEFAULT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE cities (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE cars (
  id INT NOT NULL AUTO_INCREMENT,
  city_id INT NOT NULL,
  model VARCHAR(100) NOT NULL,
  make VARCHAR(100) NOT NULL,
  description LONGTEXT default NULL,
  fuel ENUM('petrol', 'diesel', 'other') NOT NULL,
  price INT NOT NULL,
  mileage  int NOT NULL,
  reg_number varchar(20) NOT NULL,
  year int NOT NULL,
  owner int not NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(city_id) REFERENCES cities(id)
);



CREATE TABLE interested_users_cars (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(car_id) REFERENCES cars(id)
);

INSERT INTO cities (name) values ("Delhi"),("Mumbai"),("Bangalore"),("Hyderabad");
INSERT INTO admin (email,password,fullname) values ("a@admin.com","5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8","ADMIN NAME");