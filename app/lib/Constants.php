<?php

//
// Access control list constants
// 
define('__CA_ACL_NO_ACCESS__', 0);
define('__CA_ACL_READONLY_ACCESS__', 1);
define('__CA_ACL_EDIT_ACCESS__', 2);
define('__CA_ACL_EDIT_DELETE_ACCESS__', 3);

//
// Metadata alert constants
//
define('__CA_ALERT_RULE_NO_ACCESS__', 0);
define('__CA_ALERT_RULE_ACCESS_NOTIFICATION__', 1);
define('__CA_ALERT_RULE_ACCESS_ACCESS_EDIT__', 2);

//
//
//
define("__CA_ATTRIBUTE_VALUE_CONTAINER__", 0);
 	define("__CA_ATTRIBUTE_VALUE_TEXT__", 1);
define("__CA_ATTRIBUTE_VALUE_DATERANGE__", 2);
define("__CA_ATTRIBUTE_VALUE_LIST__", 3);
define("__CA_ATTRIBUTE_VALUE_GEOCODE__", 4);
 	define("__CA_ATTRIBUTE_VALUE_URL__", 5);
define("__CA_ATTRIBUTE_VALUE_CURRENCY__", 6);
define("__CA_ATTRIBUTE_VALUE_LENGTH__", 8);
 	define("__CA_ATTRIBUTE_VALUE_WEIGHT__", 9);
  	define("__CA_ATTRIBUTE_VALUE_TIMECODE__", 10);
define("__CA_ATTRIBUTE_VALUE_INTEGER__", 11);
 	define("__CA_ATTRIBUTE_VALUE_NUMERIC__", 12);
define("__CA_ATTRIBUTE_VALUE_LCSH__", 13);
define("__CA_ATTRIBUTE_VALUE_GEONAMES__", 14);
define("__CA_ATTRIBUTE_VALUE_FILE__", 15);
define("__CA_ATTRIBUTE_VALUE_MEDIA__", 16);
define("__CA_ATTRIBUTE_VALUE_INFORMATIONSERVICE__", 20);
define("__CA_ATTRIBUTE_VALUE_OBJECTREPRESENTATIONS__", 21);
define("__CA_ATTRIBUTE_VALUE_ENTITIES__", 22);
define("__CA_ATTRIBUTE_VALUE_PLACES__", 23);
define("__CA_ATTRIBUTE_VALUE_OCCURRENCES__", 24);
define("__CA_ATTRIBUTE_VALUE_COLLECTIONS__", 25);
define("__CA_ATTRIBUTE_VALUE_STORAGELOCATIONS__", 26);
define("__CA_ATTRIBUTE_VALUE_LOANS__", 27);
define("__CA_ATTRIBUTE_VALUE_MOVEMENTS__", 28);
define("__CA_ATTRIBUTE_VALUE_OBJECTS__", 29);
define("__CA_ATTRIBUTE_VALUE_OBJECTLOTS__", 30);
define("__CA_ATTRIBUTE_VALUE_FLOORPLAN__", 31);
define("__CA_ATTRIBUTE_VALUE_COLOR__", 32);
define("__CA_ATTRIBUTE_VALUE_FILESIZE__", 33);


# ----------------------------------------------------------------------
# Define parameter type constants for getParameter()
# ----------------------------------------------------------------------
if(!defined("pInteger")) { define("pInteger", 1); }
if(!defined("pFloat")) { define("pFloat", 2); }
if(!defined("pString")) { define("pString", 3); }
if(!defined("pArray")) { define("pArray", 4); }

# OS family constants
define('OS_POSIX', 0);
define('OS_WIN32', 1);


# ------------------------------------------------------------------------------------
# --- Field type constants
# ------------------------------------------------------------------------------------
define("FT_NUMBER",0);
define("FT_TEXT", 1);
define("FT_TIMESTAMP", 2);
define("FT_DATETIME", 3);
define("FT_HISTORIC_DATETIME", 4);
define("FT_DATERANGE", 5);
define("FT_HISTORIC_DATERANGE", 6);
define("FT_BIT", 7);
define("FT_FILE", 8);
define("FT_MEDIA", 9);
define("FT_PASSWORD", 10);
define("FT_VARS", 11);
define("FT_TIMECODE", 12);
define("FT_DATE", 13);
define("FT_HISTORIC_DATE", 14);
define("FT_TIME", 15);
define("FT_TIMERANGE", 16);

# ------------------------------------------------------------------------------------
# --- Display type constants
# ------------------------------------------------------------------------------------
define("DT_SELECT", 0);
define("DT_LIST", 1);
define("DT_LIST_MULTIPLE", 2);
define("DT_CHECKBOXES", 3);
define("DT_RADIO_BUTTONS", 4);
define("DT_FIELD", 5);
define("DT_HIDDEN", 6);
define("DT_OMIT", 7);
define("DT_TEXT", 8);
define("DT_PASSWORD", 9);
define("DT_COLORPICKER", 10);
define("DT_TIMECODE", 12);
define("DT_COUNTRY_LIST", 13);
define("DT_STATEPROV_LIST", 14);
define("DT_LOOKUP", 15);
define("DT_FILE_BROWSER", 16);
define("DT_INTERVAL", 17);

# ------------------------------------------------------------------------------------
# --- Access mode constants
# ------------------------------------------------------------------------------------
define("ACCESS_READ", 0);
define("ACCESS_WRITE", 1);

# ------------------------------------------------------------------------------------
# --- Hierarchy type constants
# ------------------------------------------------------------------------------------
define("__CA_HIER_TYPE_SIMPLE_MONO__", 1);
define("__CA_HIER_TYPE_MULTI_MONO__", 2);
define("__CA_HIER_TYPE_ADHOC_MONO__", 3);
define("__CA_HIER_TYPE_MULTI_POLY__", 4);

# ------------------------------------------------------------------------------------
# --- Media icon constants
# ------------------------------------------------------------------------------------
define("__CA_MEDIA_QUEUED_ICON__", 'queued');


define('__CA_BUNDLE_DISPLAY_NO_ACCESS__', 0);
define('__CA_BUNDLE_DISPLAY_READ_ACCESS__', 1);
define('__CA_BUNDLE_DISPLAY_EDIT_ACCESS__', 2);

define('__CA_BUNDLE_ACCESS_NONE__', 0);
define('__CA_BUNDLE_ACCESS_READONLY__', 1);
define('__CA_BUNDLE_ACCESS_EDIT__', 2);

/**
 * Returned by BundlableLabelableBaseModelWithAttributes::saveBundlesForScreenWillChangeParent() when parent will not be changed
 */
define('__CA_PARENT_UNCHANGED__', 0);

/**
 * Returned by BundlableLabelableBaseModelWithAttributes::saveBundlesForScreenWillChangeParent() when parent will be changed
 */
define('__CA_PARENT_CHANGED__', 1);

/**
 * Returned by BundlableLabelableBaseModelWithAttributes::saveBundlesForScreenWillChangeParent() when parent will be changed to a related collection in a object-collection hierarchy
 */
define('__CA_PARENT_COLLECTION_CHANGED__', 2);

 define('__CA_LABEL_TYPE_PREFERRED__', 0);
 define('__CA_LABEL_TYPE_NONPREFERRED__', 1);
 define('__CA_LABEL_TYPE_ANY__', 2);
 
 

define("__CA_MEDIA_VIDEO_DEFAULT_ICON__", 'video');
define("__CA_MEDIA_AUDIO_DEFAULT_ICON__", 'audio');
define("__CA_MEDIA_DOCUMENT_DEFAULT_ICON__", 'document');
define("__CA_MEDIA_3D_DEFAULT_ICON__", '3d');
define("__CA_MEDIA_SPIN_DEFAULT_ICON__", '3d');
define("__CA_MEDIA_BINARY_FILE_DEFAULT_ICON__", 'document');


define('__CA_LISTS_SORT_BY_LABEL__', 0);
define('__CA_LISTS_SORT_BY_RANK__', 1);
define('__CA_LISTS_SORT_BY_VALUE__', 2);
define('__CA_LISTS_SORT_BY_IDENTIFIER__', 3);


define('__CA_NOTIFICATION_TYPE_GENERIC__', 0);
define('__CA_NOTIFICATION_TYPE_METADATA_ALERT__', 1);
define('__CA_NOTIFICATION_TYPE_URL_REFERENCE_CHECK__', 2);


define('__CA_SET_NO_ACCESS__', 0);
define('__CA_SET_READ_ACCESS__', 1);
define('__CA_SET_EDIT_ACCESS__', 2);
