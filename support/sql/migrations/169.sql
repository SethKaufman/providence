/*
	Date: 3 August 2020
	Migration: 169
	Description:    Add sortable field for attributes
*/
/*==========================================================================*/

ALTER TABLE ca_attribute_values ADD COLUMN value_sortable varchar(100) null;
CREATE INDEX i_value_sortable ON ca_attribute_values(value_sortable);
CREATE INDEX i_sorting ON ca_attribute_values(element_id, attribute_id, value_sortable);

/* Objects */
DROP INDEX i_name on ca_object_labels;
DROP INDEX i_name_sort on ca_object_labels;
UPDATE ca_object_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_object_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_object_labels(name(255));
CREATE INDEX i_name_sort on ca_object_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_object_labels(object_id, name_sort);

/* Object representations */
UPDATE ca_object_representation_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_object_representation_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_object_representation_id on ca_object_representation_labels(representation_id);
CREATE UNIQUE INDEX u_all on ca_object_representation_labels(representation_id, name(255), type_id, locale_id);
CREATE INDEX i_locale_id on ca_object_representation_labels(locale_id);
CREATE INDEX i_type_id on ca_object_representation_labels(type_id);
CREATE INDEX i_name on ca_object_representation_labels(name(255));
CREATE INDEX i_name_sort on ca_object_representation_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_object_representation_labels(representation_id, name_sort);

/* Occurrences */
DROP INDEX u_all on ca_occurrence_labels;
DROP INDEX i_name on ca_occurrence_labels;
DROP INDEX i_name_sort on ca_occurrence_labels;
ALTER TABLE ca_occurrence_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_occurrence_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_occurrence_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name_sort on ca_occurrence_labels(name_sort);
CREATE INDEX i_name on ca_occurrence_labels(name(255));
CREATE INDEX i_key_name_sort on ca_occurrence_labels(occurrence_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_occurrence_labels(
   occurrence_id,
   name(255),
   type_id,
   locale_id
);

/* Collections */
DROP INDEX u_all on ca_collection_labels;
DROP INDEX i_name on ca_collection_labels;
DROP INDEX i_name_sort on ca_collection_labels;
ALTER TABLE ca_collection_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_collection_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_collection_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name_sort on ca_collection_labels(name_sort);
CREATE INDEX i_name on ca_collection_labels(name);
CREATE INDEX i_key_name_sort on ca_collection_labels(collection_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_collection_labels
(
   collection_id,
   name(255),
   type_id,
   locale_id
);

/* Places */
DROP INDEX u_all on ca_place_labels;
DROP INDEX i_name on ca_place_labels;
DROP INDEX i_name_sort on ca_place_labels;
ALTER TABLE ca_place_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_place_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_place_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_place_labels(name(255));
CREATE INDEX i_name_sort on ca_place_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_place_labels(place_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_place_labels
(
   place_id,
   name(255),
   type_id,
   locale_id
);

/* Storage locations */
DROP INDEX u_all on ca_storage_location_labels;
DROP INDEX i_name on ca_storage_location_labels;
DROP INDEX i_name_sort on ca_storage_location_labels;
ALTER TABLE ca_storage_location_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_storage_location_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_storage_location_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_storage_location_labels(name(25));
CREATE INDEX i_name_sort on ca_storage_location_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_storage_location_labels(location_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_storage_location_labels
(
   location_id,
   name(255),
   locale_id,
   type_id
);

/* Loans */
UPDATE ca_loan_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_loan_labels MODIFY COLUMN name_sort varchar(255) not null default '';
DROP INDEX i_name on ca_loan_labels;
CREATE INDEX i_name on ca_loan_labels(name(255));
DROP INDEX i_name_sort on ca_loan_labels;
CREATE INDEX i_name_sort on ca_loan_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_loan_labels(loan_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_loan_labels
(
   loan_id,
   name(255),
   locale_id,
   type_id
);

/* Movements */
UPDATE ca_movement_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_movement_labels MODIFY COLUMN name_sort varchar(255) not null default '';
DROP INDEX i_name on ca_movement_labels;
DROP INDEX i_name_sort on ca_movement_labels;
CREATE INDEX i_name on ca_movement_labels(name(255));
CREATE INDEX i_name_sort on ca_movement_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_movement_labels(movement_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_movement_labels
(
   movement_id,
   name(255),
   locale_id,
   type_id
);

/* Representation annotation labels */
DROP INDEX u_all on ca_representation_annotation_labels;
DROP INDEX i_name on ca_representation_annotation_labels;
DROP INDEX i_name_sort on ca_representation_annotation_labels;
UPDATE ca_representation_annotation_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_representation_annotation_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_representation_annotation_labels(name(255));
CREATE INDEX i_name_sort on ca_representation_annotation_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_representation_annotation_labels(annotation_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_representation_annotation_labels
(
   name(255),
   locale_id,
   type_id,
   annotation_id
);

/* Object lots */
DROP INDEX i_name on ca_object_lot_labels;
DROP INDEX i_name_sort on ca_object_lot_labels;
UPDATE ca_object_lot_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_object_lot_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_object_lot_labels(name(255));
CREATE INDEX i_name_sort on ca_object_lot_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_object_lot_labels(lot_id, name_sort);

/* List item labels */
UPDATE ca_list_item_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_list_item_labels MODIFY COLUMN name_sort varchar(255) not null default '';
DROP INDEX i_name ON ca_list_item_labels;
DROP INDEX i_name_sort ON ca_list_item_labels;
DROP INDEX i_name_singular ON ca_list_item_labels;
CREATE INDEX i_name_sort ON ca_list_item_labels(name_sort);
CREATE INDEX i_key_name_sort ON ca_list_item_labels(item_id, name_sort);
CREATE INDEX i_name_singular ON ca_list_item_labels(item_id, name_singular);
CREATE INDEX i_name ON ca_list_item_labels(item_id, name_plural);

/* Data importer labels */
UPDATE ca_data_exporter_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_data_exporter_labels MODIFY COLUMN name_sort varchar(255) not null default '';
#DROP INDEX i_name on ca_data_importer_labels;
DROP INDEX i_name_sort on ca_data_importer_labels;
CREATE INDEX i_name on ca_data_importer_labels(name);
CREATE INDEX i_name_sort on ca_data_importer_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_data_importer_labels(importer_id, name_sort);

/* Data exporter labels */
UPDATE ca_data_exporter_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_data_exporter_labels MODIFY COLUMN name_sort varchar(255) not null default '';
#DROP INDEX i_name on ca_data_exporter_labels;
DROP INDEX i_name_sort on ca_data_exporter_labels;
CREATE INDEX i_name on ca_data_exporter_labels(name);
CREATE INDEX i_name_sort on ca_data_exporter_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_data_exporter_labels(exporter_id, name_sort);

/* Entities */
UPDATE ca_entity_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_entity_labels MODIFY COLUMN name_sort varchar(255) not null default '';
DROP INDEX i_forename on ca_entity_labels;
DROP INDEX i_surname on ca_entity_labels;
DROP INDEX i_name_sort on ca_entity_labels;
CREATE INDEX i_forename on ca_entity_labels(forename);
CREATE INDEX i_surname on ca_entity_labels(surname(255));
CREATE INDEX i_name_sort on ca_entity_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_entity_labels(entity_id, name_sort);

/* Search form labels */
UPDATE ca_search_form_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_search_form_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_search_form_labels(name);
CREATE INDEX i_name_sort on ca_search_form_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_search_form_labels(form_id, name_sort);

/* Bundle display labels */
UPDATE ca_bundle_display_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_bundle_display_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_bundle_display_labels(name);
CREATE INDEX i_name_sort on ca_bundle_display_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_bundle_display_labels(display_id, name_sort);

/* Tours */
DROP INDEX i_name on ca_tour_labels;
DROP INDEX i_name_sort on ca_tour_labels;
ALTER TABLE ca_tour_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_tour_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_tour_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_tour_labels(name(255));
CREATE INDEX i_name_sort on ca_tour_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_tour_labels(tour_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_tour_labels
(
   name(255),
   locale_id,
   tour_id
);

/* Tour stops */
DROP INDEX i_name on ca_tour_stop_labels;
DROP INDEX i_name_sort on ca_tour_stop_labels;
ALTER TABLE ca_tour_stop_labels MODIFY COLUMN name varchar(1024) not null default '';
UPDATE ca_tour_stop_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_tour_stop_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_tour_stop_labels(name(255));
CREATE INDEX i_name_sort on ca_tour_stop_labels(name_sort);
#CREATE INDEX i_key_name_sort on ca_tour_stop_labels(stop_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_tour_stop_labels
(
   name(255),
   locale_id,
   stop_id
);

/* Metadata dictionary */
UPDATE ca_metadata_dictionary_entry_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_metadata_dictionary_entry_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_metadata_dictionary_entry_labels(name);
CREATE INDEX i_name_sort on ca_metadata_dictionary_entry_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_metadata_dictionary_entry_labels(entry_id, name_sort);

/* User representation annotations */
DROP INDEX u_all on ca_user_representation_annotation_labels;
DROP INDEX i_name on ca_user_representation_annotation_labels;
DROP INDEX i_name_sort on ca_user_representation_annotation_labels;
UPDATE ca_user_representation_annotation_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_user_representation_annotation_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_user_representation_annotation_labels(name(255));
CREATE INDEX i_name_sort on ca_user_representation_annotation_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_user_representation_annotation_labels(annotation_id, name_sort);
CREATE UNIQUE INDEX u_all on ca_user_representation_annotation_labels
(
  name(255),
  locale_id,
  type_id,
  annotation_id
);

/* Metadata alert labels */
UPDATE ca_metadata_alert_rule_labels set name_sort = substr(name_sort, 1, 255) where length(name_sort) > 255;
ALTER TABLE ca_metadata_alert_rule_labels MODIFY COLUMN name_sort varchar(255) not null default '';
CREATE INDEX i_name on ca_metadata_alert_rule_labels(name);
CREATE INDEX i_name_sort on ca_metadata_alert_rule_labels(name_sort);
CREATE INDEX i_key_name_sort on ca_metadata_alert_rule_labels(rule_id, name_sort);

/*==========================================================================*/

/* Always add the UPDATE to ca_schema_updates at the end of the file */
INSERT IGNORE INTO ca_schema_updates (version_num, datetime) VALUES (169, unix_timestamp());
