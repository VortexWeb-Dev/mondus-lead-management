<?php
require_once __DIR__ . "/crest/crest.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
    $file = $_FILES['csvFile'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);

        if ($fileType === 'text/csv' || pathinfo($fileName, PATHINFO_EXTENSION) === 'csv') {
            if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                $headers = fgetcsv($handle);
                $rowCount = 0;
                $data = [];

                while (($row = fgetcsv($handle)) !== false) {
                    $data[] = array_combine($headers, $row);
                    $rowCount++;
                }
                fclose($handle);

                $fieldMapping = [
                    "source" => "ufCrm4Source",
                    "lead_name" => "ufCrm4LeadName",
                    "phone" => "ufCrm4Phone",
                    "project_building" => "ufCrm4ProjectOrBuilding",
                    "type" => "ufCrm4Type",
                    "unit_no" => "ufCrm4UnitNo",
                    "size" => "ufCrm4Size",
                    "area_name" => "ufCrm4AreaName",
                    "buyer_seller" => "ufCrm4BuyerOrSeller",
                    "building_name_2" => "ufCrm_4_BUILDING_NAME_2",
                    "rooms" => "ufCrm4Rooms",
                    "bathrooms" => "ufCrm4Bathrooms",
                    "parking" => "ufCrm4Parking",
                    "furnished" => "ufCrm4Furnished",
                    "master_project" => "ufCrm4MasterProject",
                    "view" => "ufCrm4View",
                ];

                foreach ($data as $row) {
                    $itemFields = [
                        'entityTypeId' => 1040,
                        'fields' => []
                    ];

                    foreach ($fieldMapping as $csvField => $bitrixField) {
                        if (isset($row[$csvField])) {
                            $value = $row[$csvField];

                            if (in_array($bitrixField, ['EMAIL', 'PHONE'])) {
                                $itemFields['fields'][$bitrixField] = [
                                    [
                                        'VALUE' => $value,
                                        'VALUE_TYPE' => $bitrixField === 'EMAIL' ? 'WORK' : 'MOBILE'
                                    ]
                                ];
                            } else {
                                $itemFields['fields'][$bitrixField] = $value;
                            }
                        }
                    }

                    $response = CRest::call('crm.item.add', $itemFields);

                    if (isset($response['error'])) {
                        error_log("Error adding item: " . json_encode($response));
                    }
                }

                header("Location: index.php");
                exit;
            } else {
                echo "Error: Unable to open the CSV file.";
            }
        } else {
            echo "Error: Please upload a valid CSV file.";
        }
    } else {
        echo "Error: File upload failed with error code " . $file['error'];
    }
} else {
    echo "Error: No file uploaded.";
}
