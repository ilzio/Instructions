$(function(){function p(){$("input#file").val(""),$(".help-text").show(),$("#file-input-clear").hide(),$("#upload-button").html('Anexar Arquivo <i class="fas fa-file"></i>')}$("#file-input-clear").on("click",function(e){e.preventDefault(),p()}),$(document).ajaxStart(function(){$("#loader").show(),$("#loader-overlay").show()}),$(document).ajaxStop(function(){$("#loader").hide(),$("#loader-overlay").hide()}),$("input[type=file]").on("change",function(){var e,t,a,n,o=$("input#file")[0].files[0],i=o.type.split("/")[1],s=o.size;$("#btn-submit");if($(".help-text").hide(),permitted=["pdf","doc","docx","jpeg","jpg"],-1==permitted.indexOf(i))return swal({title:"Formato invalido!",text:"Os formatos permitidos são: .pfd, .doc, .docx, .jpg e .jpeg",icon:"error",button:"Fechar"}),void p();if(6e6<s)return swal({title:"Tamanho invalido!",text:"O tamanho maximo permitido e de 6 MB",icon:"error",button:"Fechar"}),void p();$("#upload-button").text((e=$("input#file")[0].files[0].name,t=14,a=e.substring(e.lastIndexOf(".")+1,e.length).toLowerCase(),(n=e.replace("."+a,"")).length<=t?e:(n=n.substr(0,t)+(e.length>t?"...":""))+"."+a)),$("#file-input-clear").show(),$(".help-text").hide()}),$("#contactForm input,#contactForm textarea,#contactForm select").jqBootstrapValidation({preventSubmit:!0,submitError:function(e,t,a){},submitSuccess:function(e,t){t.preventDefault();var a=$("input#name").val(),n=$("input#email").val(),o=$("input#phone").val(),i=$("textarea#message").val(),s=$("input#city").val(),l=$("option:selected").val();if(null!=$("input#file")[0].files[0])var r=$("input#file")[0].files[0];else r="";var c=a;0<=c.indexOf(" ")&&(c=a.split(" ").slice(0,-1).join(" ")),$this=$("#btn-submit"),$this.prop("disabled",!0);var u=new FormData;u.append("name",a),u.append("email",n),u.append("phone",o),u.append("message",i),u.append("subject",l),u.append("city",s),u.append("userfile",r),$.ajax({url:"/mail/contact_me.php",type:"POST",processData:!1,contentType:!1,data:u,cache:!1,success:function(){swal({title:"Mensagem inviada com sucesso!",text:"Obrigado "+c+", lhe responderemos em breve",icon:"success",button:"Fechar"}),$("#success > .alert-success").append("<strong>A sua mensagem foi enviada com sucesso.</strong>"),$("#success > .alert-success").append("</div>"),$("#contactForm").trigger("reset"),1!=$(".modal").length&&$("#serviço").select2(),($("modal").length=1)&&$(".modal").modal("toggle"),p()},error:function(e,t,a){console.log(e),console.log(t,a),$("#success").html("<div class='alert alert-danger'>"),$("#success > .alert-danger").html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>"),$("#success > .alert-danger").append($("<strong>").text("Houve um erro no envio da sua mensajem. Por favor intente de novo.")),$("#success > .alert-danger").append("</div>"),$("#contactForm").trigger("reset"),p()},complete:function(){setTimeout(function(){$this.prop("disabled",!1)},1e3)}})},filter:function(){return $(this).is(":visible")}}),$('a[data-toggle="tab"]').click(function(e){e.preventDefault(),$(this).tab("show")})}),$("#name").focus(function(){$("#success").html("")});