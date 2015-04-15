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
        name: 'gestionUtilisateur',
        path: '../assets/bundle/',
        mode: 'both',
        language: lang,
        callback: function () {
            //$("#msg_welcome").text($.i18n.prop('msg_welcome'));
            $("#msg_welcome").text(msg_welcome);
            $("#btn_quit").text(btn_quit);
            $("#msg_welcome").text(msg_welcome);
            $("#btn_quit").text(btn_quit);
            $("#lnk_accueil").text(lnk_accueil);
            $("#lnk_module").text(lnk_module);
            $("#lnk_smodule").text(lnk_smodule);
            $("#lb_gestUsers").text(lb_gestUsers);
            $("#btn_edit").text(btn_edit);
            $("#btn_add").text(btn_add);
            $("#btn_delete").text(btn_delete);
            $("#lb_lstGroups").text(lb_lstGroups);            
            $("#hd_fName").text(hd_fName);
            $("#hd_name").text(hd_name);
            $("#hd_mail").text(hd_mail);
            $("#hd_profile").text(hd_profile);
            $("#hd_struct").text(hd_struct);
            $("#hd_group").text(hd_group);  
        }
    });
}