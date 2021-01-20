<?
global $MESS;
$PathInstall = str_replace("\\", "/", __FILE__);
$PathInstall = substr($PathInstall, 0, strlen($PathInstall)-strlen("/index.php"));
IncludeModuleLangFile($PathInstall."/install.php");

Class unisender_integration extends CModule
{
    var $MODULE_ID = "unisender.integration";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function unisender_integration()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        else
        {
            $this->MODULE_VERSION = "1.0.0";
            $this->MODULE_VERSION_DATE = "2019-06-04 12:00:00";
        }

        $this->MODULE_NAME = "Интеграция с Unisender";
        $this->MODULE_DESCRIPTION = "Интеграция с Unisender";
    }

    function InstallDB($arParams = array())
    {
        return true;
    }

    function UnInstallDB($arParams = array())
    {
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        return true;
    }

    function UnInstallFiles()
    {
        return true;    
    }

    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->InstallDB();
        $this->InstallFiles();
        RegisterModule("unisender.integration");
        $APPLICATION->IncludeAdminFile(GetMessage("COMPRESS_INSTALL_TITLE"), $DOCUMENT_ROOT."/bitrix/modules/unisender.integration/install/step.php");
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $this->UnInstallDB();
        $this->UnInstallFiles();
        UnRegisterModule("unisender.integration");
        $APPLICATION->IncludeAdminFile(GetMessage("COMPRESS_UNINSTALL_TITLE"), $DOCUMENT_ROOT."/bitrix/modules/unisender.integration/install/unstep.php");
    }
}
?>