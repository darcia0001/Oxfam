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
        name: 'ajouteoperation',
        path: 'assets/bundle/',
        mode: 'both',
        language: lang,
        callback: function ()
        {
            //$("#msg_welcome").text($.i18n.prop('msg_welcome'));

            $("#lb_mdpOK").text(lb_mdpOK);
            $("#lb_pwdMatch").text(lb_pwdMatch);
            $("#lb_pwdDiff").text(lb_pwdDiff);
            $("#lb_shortPwd").text(lb_shortPwd);
            $("#msg_welcome").text(msg_welcome);
            $("#btn_quit").text(btn_quit);
            $("#btn_quit").text(btn_quit);
            $("#lnk_accueil").text(lnk_accueil);
            $("#lnk_module").text(lnk_module);
            $("#lnk_smodule").text(lnk_smodule);
            $("#lb_gestOp").text(lb_gestOp);
            $(".opt_agOxf").text(opt_agOxf);
            $(".opt_agProj").text(opt_agProj);
            $("#lb_group").text(lb_group);
            $("#opt_gestProj").text(opt_gestProj);
            $("#opt_opProj").text(opt_opProj);
            $("#opt_admin").text(opt_admin);
            $("#opt_agCtrl").text(opt_agCtrl);
            $("#opt_agValid").text(opt_agValid);
            $("#lb_backTop").text(lb_backTop);
            $("#lb_confid").text(lb_confid);
            $("#lb_terms").text(lb_terms);
        }
    });
}