CREATE DATABASE microposts;

CREATE  TABLE microposts.signup ( 
    id INT  AUTO_INCREMENT  NOT  NULL  PRIMARY  KEY , 
    name VARCHAR ( 100 ),
    email VARCHAR ( 100 ),
    password VARCHAR ( 100 ),
    created_at TIMESTAMP  NOT  NULL  DEFAULT CURRENT_TIMESTAMP 
);

CREATE  TABLE microposts.timeline ( 
    id INT  AUTO_INCREMENT  NOT  NULL  PRIMARY  KEY , 
    userid int NOT NULL,
    word VARCHAR ( 100 ),
    created_at TIMESTAMP  NOT  NULL  DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE microposts.followtable (
    id INT  AUTO_INCREMENT  NOT  NULL  PRIMARY  KEY , 
    userid int NOT NULL,
    followid int NOT NULL,
    created_at TIMESTAMP  NOT  NULL  DEFAULT CURRENT_TIMESTAMP 
);