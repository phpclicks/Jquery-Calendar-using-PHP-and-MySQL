CREATE TABLE fc_events_table(

  id int(11) NOT NULL AUTO_INCREMENT,

  start datetime DEFAULT NULL,

  end datetime DEFAULT NULL,

  title text,

  PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;