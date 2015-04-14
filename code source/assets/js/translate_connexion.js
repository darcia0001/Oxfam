// load I18N bundles
$(document).ready(function ()
{
    loadBundles($.i18n.browserLang());
    // configure language combo box
    $('#lang').change(function ()
    {
        var selection = $('#lang option:selected').val();
        loadBundles(selection !== 'browser' ? selection : $.i18n.browserLang());
    });
});

function loadBundles(lang)
{
    $.i18n.properties({
        name: 'connexion',
        path: '../assets/bundle/',
        mode: 'both',
        language: lang,
        callback: function ()
        {
            //$("#msg_welcome").text($.i18n.prop('msg_welcome'));
            $("#btn_connect").text(btn_connect)
            $("#tb_login").attr("placeholder", tb_login)
            $("#tb_pwd").attr("placeholder", tb_pwd)

        }
    });
}