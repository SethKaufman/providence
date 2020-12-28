/*
	Date: 27 December 2020
	Migration: 167
	Description:    Add index tables for new "SQLBrowse" browse engine plugin
*/

/*==========================================================================*/

CREATE TABLE ca_browse_references (
    row_id int unsigned not null, 
    value_id int unsigned not null, 
    access tinyint unsigned not null default 0,
    
    primary key (row_id, value_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE INDEX i_all ON ca_browse_references(row_id, value_id, access);


CREATE TABLE ca_browse_facets (
	facet_id smallint unsigned not null AUTO_INCREMENT,
	name varchar(255) not null,
	code varchar(255) not null,
    table_num tinyint unsigned not null,

    primary key (facet_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE UNIQUE INDEX u_name ON ca_browse_facets(name);
CREATE UNIQUE INDEX u_code ON ca_browse_facets(code);


CREATE TABLE ca_browse_values (
    value_id int unsigned not null AUTO_INCREMENT,
    facet_id smallint unsigned not null references ca_browse_facets(facet_id),
    value varchar(512) not null, 
    value_sort varchar(512) not null, 
    item_id int unsigned null references ca_list_item(item_id), 
    parent_id int unsigned null references ca_browse_value(value_id), 
    
    primary key (value_id)
) engine=innodb CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE INDEX i_facet_id ON ca_browse_values(facet_id);
CREATE INDEX i_value ON ca_browse_values(value,facet_id);
CREATE INDEX i_value_sort ON ca_browse_values(value_sort,facet_id);
CREATE INDEX i_item_id ON ca_browse_values(item_id);
CREATE INDEX i_parent_id ON ca_browse_values(parent_id);

/*==========================================================================*/

/* Always add the update to ca_schema_updates at the end of the file */
INSERT IGNORE INTO ca_schema_updates (version_num, datetime) VALUES (167, unix_timestamp());
