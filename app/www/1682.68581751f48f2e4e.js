"use strict";(self.webpackChunkapp=self.webpackChunkapp||[]).push([[1682],{1682:(C,_,a)=>{a.r(_),a.d(_,{PagosPageModule:()=>s});var u=a(177),i=a(4341),o=a(7863),h=a(8986),r=a(1977),p=a(4438);const d=[{path:"",component:r.C}];let P=(()=>{var t;class e{}return(t=e).\u0275fac=function(l){return new(l||t)},t.\u0275mod=p.$C({type:t}),t.\u0275inj=p.G2t({imports:[h.iI.forChild(d),h.iI]}),e})();var g=a(5553);let s=(()=>{var t;class e{}return(t=e).\u0275fac=function(l){return new(l||t)},t.\u0275mod=p.$C({type:t}),t.\u0275inj=p.G2t({imports:[u.MD,i.YN,o.bv,P,g.h]}),e})()},1977:(C,_,a)=>{a.d(_,{C:()=>P});var u=a(467),i=a(5312),o=a(4438),h=a(431),r=a(7863),p=a(8856),d=a(4341);let P=(()=>{var g;class s{constructor(e,n,l,c){this.stellar=e,this.modalCtrl=n,this.oCom=l,this.loadingCtrl=c,this.tienda={},this.cantidad=0,this.mensaje="",this.laTienda={id:"",nombre:"",hash:"",logo:"",public:"",info:"",cuenta:"",CIF:"",contacto:"",direccion:"",movil:"",correo:"",coordenadas:""}}ngOnInit(){var e=this;return(0,u.A)(function*(){e.token=yield e.oCom.getTokenPromise(i.c.login,i.c.password),""!=e.token&&(yield e.oCom.getUnComercio(e.token,e.tienda.id).then(n=>{console.log("A ver ese comercio",n),e.tienda.logo=n.logo})),(null==e.tienda.logo||""==e.tienda.logo)&&(e.tienda.logo=i.c.logo_vacio)})()}showLoading(){var e=this;return(0,u.A)(function*(){(yield e.loadingCtrl.create({showBackdrop:!0,backdropDismiss:!1,translucent:!0,duration:0,mode:"ios"})).present()})()}pagar(){var e=this;return(0,u.A)(function*(){e.mensaje="",e.showLoading();try{e.oCom.getEstadoCuenta(i.c.publicUsuario,e.token).then(n=>{e.stellar.TransferirCripto(e.tienda.clave,i.c.secretUsuario,n.emisora,e.cantidad),setTimeout(()=>{e.loadingCtrl.dismiss(),e.salirSin()},1e4)})}catch(n){console.log("ha petao",n),e.mensaje="Error realizando pago",setTimeout(()=>{e.loadingCtrl.dismiss()},3e3)}})()}salirSin(){this.modalCtrl.dismiss(!1)}salirCon(){this.modalCtrl.dismiss(!0)}}return(g=s).\u0275fac=function(e){return new(e||g)(o.rXU(h.x),o.rXU(r.W3),o.rXU(p.M),o.rXU(r.Xi))},g.\u0275cmp=o.VBU({type:g,selectors:[["app-pagos"]],inputs:{tienda:"tienda"},decls:19,vars:5,consts:[[1,"ion-padding",3,"fullscreen"],[3,"src"],[1,"input-item"],["type","text","placeholder","Cantidad","name","txtCantidad",3,"ngModelChange","ngModel"],["expand","block",1,"login-button",3,"click"],["expand","block","expand","block","color","light",1,"google-button",3,"click"],["color","white"],[1,"copyright"]],template:function(e,n){1&e&&(o.j41(0,"ion-header")(1,"ion-toolbar")(2,"ion-title"),o.EFF(3),o.k0s()()(),o.j41(4,"ion-content",0),o.nrm(5,"ion-img",1),o.j41(6,"ion-item")(7,"fieldset",2)(8,"legend"),o.EFF(9,"Cantidad ILLAs"),o.k0s(),o.j41(10,"ion-input",3),o.mxI("ngModelChange",function(c){return o.DH7(n.cantidad,c)||(n.cantidad=c),c}),o.k0s()()(),o.j41(11,"ion-button",4),o.bIt("click",function(){return n.pagar()}),o.EFF(12," Pagar "),o.k0s(),o.j41(13,"ion-button",5),o.bIt("click",function(){return n.salirSin()}),o.EFF(14," Volver "),o.k0s()(),o.j41(15,"ion-footer",6)(16,"ion-toolbar")(17,"p",7),o.EFF(18),o.k0s()()()),2&e&&(o.R7$(3),o.JRh(n.tienda.nombre),o.R7$(),o.Y8G("fullscreen",!0),o.R7$(),o.FS9("src",n.tienda.logo),o.R7$(5),o.R50("ngModel",n.cantidad),o.R7$(8),o.JRh(n.mensaje))},dependencies:[d.BC,d.vS,r.Jm,r.W9,r.M0,r.eU,r.KW,r.$w,r.uz,r.BC,r.ai,r.Gw]}),s})()},8856:(C,_,a)=>{a.d(_,{M:()=>p});var u=a(467),i=a(1626),o=a(5312),h=a(4438);const r=o.c.servidorVst;let p=(()=>{var d;class P{constructor(s){this.http=s}getToken(s="",t=""){let e=new i.Lr;const n=(new i.Nl).set("username",s).set("password",t).set("grant_type","password");return e.append("Content-Type","application/x-www-form-urlencoded"),this.http.post(r+"login",n,{headers:e})}getTokenPromise(s="",t=""){var e=this;return(0,u.A)(function*(){return new Promise((n,l)=>{let c=new i.Lr;const m=(new i.Nl).set("username",s).set("password",t).set("grant_type","password");c.append("Content-Type","application/x-www-form-urlencoded"),e.http.post(r+"login",m,{headers:c}).subscribe({next:v=>{n(v.access_token)},error:v=>{l("")}})})})()}getEstadoCuenta(s="",t=""){var e=this;return(0,u.A)(function*(){return new Promise((n,l)=>{const c=(new i.Lr).set("Authorization","Bearer "+t);e.http.get(r+"cuenta/"+s,{headers:c}).subscribe({next:m=>{console.log("valor",m),n(m)},error:m=>{l("")}})})})()}registrarCuenta(s="",t=""){const e=(new i.Lr).set("Authorization","Bearer "+t);return console.log(t),e.set("Accept","*/*"),e.set("Connection","keep-alive"),this.http.post(r+"cuenta/"+s,null,{headers:e})}autorizarCuenta(s="",t=""){const e=(new i.Lr).set("Authorization","Bearer "+t);return console.log(t),e.set("Accept","*/*"),e.set("Connection","keep-alive"),this.http.post(r+"cuenta/"+s+"/autorizacion",null,{headers:e})}getComercios(s=""){let t=(new i.Lr).set("Authorization","Bearer "+s);return t.append("Content-Type","application/json"),this.http.get(r+"comercios",{headers:t})}getUnComercio(s="",t=""){var e=this;return(0,u.A)(function*(){return yield new Promise((n,l)=>{let c=(new i.Lr).set("Authorization","Bearer "+s);c.append("Content-Type","application/json"),e.http.get(r+"comercio/"+t,{headers:c}).subscribe({next:m=>{n(m)},error:m=>{l("")}})})})()}}return(d=P).\u0275fac=function(s){return new(s||d)(h.KVO(i.Qq))},d.\u0275prov=h.jDH({token:d,factory:d.\u0275fac,providedIn:"root"}),P})()}}]);