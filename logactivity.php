<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Bizproc\FieldType;

class CBPWLogActivity extends CBPActivity
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

        $this->SetPropertyTypes(
            array(
                "Title" => array(
                    "Type" => FieldType::STRING
                ),
                "Content" => array(
                    "Type" => FieldType::STRING
                ),
                "FilePath" => array(
                    "Type" => FieldType::STRING
                )
            )
        );
    }
    /**
     * Start the execution of activity
     * 
     * @return CBPActivityExecutionStatus
     */
    public function Execute()
    {
        $file = fopen($_SERVER["DOCUMENT_ROOT"] . $this->FilePath, "a+");

        $logContent = "\n--" . date("d/m/Y G:i:s") . "----------------------\n";
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
     */
    public static function GetPropertiesDailog($documentType, $activityName, $arWorkflowTemplate, $arWorkflowParameters, $arWorkflowVariables, $arCurrentValues = null, $formName = "")
    {
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
     * @param array &$errors
     */
    public static function GetPropertiesDialogValues($documentType, $activityName, &$arWorkflowTemplate, &$arWorkflowParameters, &$arWorkflowVariables, $arCurrentValues, &$errors)
    {
    }
}
