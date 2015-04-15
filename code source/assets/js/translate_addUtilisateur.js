// load I18N bundles
$(document).ready(function () {
    loadBundles($.i18n.browserLang());
    // configure language combo box
    $('#lang').change(function () {
        var selection = $('#lang option:selected').val();
        loadBundles(selection !== 'browser' ? selection : $.i18n.browserLang());
    });
});

function loadBundles(lang) {
    $.i18n.properties({
        name: 'addUtilisateur',
        path: '../assets/bundle/',
        mode: 'both',
        language: lang,
        callback: function () {

            $("#lb_editUsers").text(lb_editUsers);
            $("#lb_addUsers").text(lb_addUsers);
            $(".lb_userFound").text(lb_userFound);
            $(".lb_fName").text(lb_fName);
            $(".lb_name").text(lb_name);
            $(".lb_mail").text(lb_mail);
            $(".lb_profile").text(lb_profile);
            $(".lb_pwd").text(lb_pwd);
            $(".lb_verifPwd").text(lb_verifPwd);
            $(".btn_submit").text(btn_submit);
            $(".btn_cancel").text(btn_cancel);
            $(".opt_agOxf").text(opt_agOxf);
            $(".opt_agProj").text(opt_agProj);
            $("#lb_struct").text(lb_struct);
            $("#lb_group").text(lb_group);
            $("#opt_gestProj").text(opt_gestProj);
            $("#opt_opProj").text(opt_opProj);
            $("#opt_admin").text(opt_admin);
            $("#opt_agCtrl").text(opt_agCtrl);
            $("#opt_agValid").text(opt_agValid);
            $("#btn_active").text(btn_active);
            $(".lb_userNotFound").text(lb_userNotFound);
            $(".lb_editSuccess").text(lb_editSuccess);
            $("#lb_backTop").text(lb_backTop);
            $("#lb_confid").text(lb_confid);
            $("#lb_terms").text(lb_terms);
         }
    });
}