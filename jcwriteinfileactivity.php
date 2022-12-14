<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Bizproc\FieldType;

class CBPJCWriteInFileActivity extends CBPActivity
{
    /**
     * Initialize activity
     * 
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->arProperties = array(
            "Title" => "",
            "Content" => "",
            "FilePath" => "",
        );

        $this->SetPropertiesTypes(array(
            "Content" => array(
                "Type" => FieldType::STRING
            ),
            "FilePath" => array(
                "Type" => FieldType::STRING
            )
        ));
    }
    /**
     * Start the execution of activity
     * 
     * @return CBPActivityExecutionStatus
     */
    public function Execute()
    {
        $file = fopen($_SERVER["DOCUMENT_ROOT"] . $this->FilePath, "a+");

        $logContent = "\n--" . date("d/m/Y G:i:s") . "-----------------------------\n";
        $logContent .= $this->Content;
        $logContent .= "\n--------------------------------------------------\n";

        fwrite($file, $logContent, true);
        fclose($file);

        return CBPActivityExecutionStatus::Closed;
    }

    /**
     * Generate setting form
     * 
     * @param array $documentType
     * @param string $activityName
     * @param array $arWorkflowTemplate
     * @param array $arWorkflowParameters
     * @param array $arWorkflowVariables
     * @param array $arCurrentValues
     * @param string $formName
     * @return string
     */
    public static function GetPropertiesDialog($documentType, $activityName, $arWorkflowTemplate, $arWorkflowParameters, $arWorkflowVariables, $arCurrentValues = null, $formName = "")
    {
        $runtime = CBPRuntime::GetRuntime();

        if (!is_array($arCurrentValues)) {
            $arCurrentValues = array(
                "Content" => "",
                "FilePath" => ""
            );

            $arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
            if (is_array($arCurrentActivity["Properties"])) {
                $arCurrentValues["Content"] = $arCurrentActivity["Properties"]["Content"];
                $arCurrentValues["FilePath"] = $arCurrentActivity["Properties"]["FilePath"];
            }
        }

        return $runtime->ExecuteResourceFile(
            __FILE__,
            "properties_dialog.php",
            array(
                "arCurrentValues" => $arCurrentValues,
                "formName" => $formName,
            )
        );
    }

    /**
     * Process form submition
     * 
     * @param array $documentType
     * @param string $activityName
     * @param array &$arWorkflowTemplate
     * @param array &$arWorkflowParameters
     * @param array &$arWorkflowVariables
     * @param array &$arCurrentValues
     * @param array &$arErrors
     * @return boolean
     */
    public static function GetPropertiesDialogValues($documentType, $activityName, &$arWorkflowTemplate, &$arWorkflowParameters, &$arWorkflowVariables, $arCurrentValues, &$arErrors)
    {
        $arProperties = array(
            "Content" => $arCurrentValues["Content"],
            "FilePath" => $arCurrentValues["FilePath"]
        );

        $arErrors = self::ValidateProperties($arProperties, new CBPWorkflowTemplateUser(CBPWorkflowTemplateUser::CurrentUser));
        if (count($arErrors) > 0) {
            return false;
        }

        $currentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
        $currentActivity["Properties"] = $arProperties;

        return true;
    }

    /**
     * Validate properties
     * 
     * @param array $arTestProperties
     * @param CBPWorkflowTemplateUser $user
     * @return array
     */

    public static function ValidateProperties($arTestProperties = array(), CBPWorkflowTemplateUser $user = null)
    {
        $arErrors = array();

        if (empty($arTestProperties["Content"])) {
            $arErrors[] = array(
                "code" => "emptyText",
                "message" => GetMessage("JC_WL2F_CONTENT_EMPTY"),
            );
        }
        if (empty($arTestProperties["FilePath"])) {
            $arErrors[] = array(
                "code" => "emptyText",
                "message" => GetMessage("JC_WL2F_FILE_PATH_EMPTY"),
            );
        }
        return array_merge($arErrors, parent::ValidateProperties($arTestProperties, $user));
    }
}
