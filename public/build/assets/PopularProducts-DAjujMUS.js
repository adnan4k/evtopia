import{S as ee,a as ae}from"./swiper-vue-BB6S2gtq.js";import{N as oe}from"./navigation-mOXyV9i5.js";import{f as le,a as ce,m as o,g as te}from"./swiper-D8GLvp5l.js";/* empty css                   */import{J as de,D as ue,E as pe,i as fe,P as ge,j as ve,o as c,c as d,a as r,n as Z,t as p,f as h,b as _,u as y,Q as me,R as he,$ as we,l as xe,h as J,r as ie,g as ye,w as Q,F as ne,d as re,e as be}from"./app-BbUmsuxO.js";function Y(v){return v===void 0&&(v=""),`.${v.trim().replace(/([\.:!+\/])/g,"\\$1").replace(/ /g,".")}`}function _e(v){let{swiper:t,extendParams:L,on:u}=v;L({a11y:{enabled:!0,notificationClass:"swiper-notification",prevSlideMessage:"Previous slide",nextSlideMessage:"Next slide",firstSlideMessage:"This is the first slide",lastSlideMessage:"This is the last slide",paginationBulletMessage:"Go to slide {{index}}",slideLabelMessage:"{{index}} / {{slidesLength}}",containerMessage:null,containerRoleDescriptionMessage:null,containerRole:null,itemRoleDescriptionMessage:null,slideRole:"group",id:null,scrollOnFocus:!0}}),t.a11y={clicked:!1};let f=null,i,m,z=new Date().getTime();function k(e){const n=f;n.length!==0&&(n.innerHTML="",n.innerHTML=e)}function P(e){const n=()=>Math.round(16*Math.random()).toString(16);return"x".repeat(e).replace(/x/g,n)}function E(e){e=o(e),e.forEach(n=>{n.setAttribute("tabIndex","0")})}function B(e){e=o(e),e.forEach(n=>{n.setAttribute("tabIndex","-1")})}function g(e,n){e=o(e),e.forEach(s=>{s.setAttribute("role",n)})}function a(e,n){e=o(e),e.forEach(s=>{s.setAttribute("aria-roledescription",n)})}function I(e,n){e=o(e),e.forEach(s=>{s.setAttribute("aria-controls",n)})}function M(e,n){e=o(e),e.forEach(s=>{s.setAttribute("aria-label",n)})}function q(e,n){e=o(e),e.forEach(s=>{s.setAttribute("id",n)})}function O(e,n){e=o(e),e.forEach(s=>{s.setAttribute("aria-live",n)})}function V(e){e=o(e),e.forEach(n=>{n.setAttribute("aria-disabled",!0)})}function R(e){e=o(e),e.forEach(n=>{n.setAttribute("aria-disabled",!1)})}function b(e){if(e.keyCode!==13&&e.keyCode!==32)return;const n=t.params.a11y,s=e.target;if(!(t.pagination&&t.pagination.el&&(s===t.pagination.el||t.pagination.el.contains(e.target))&&!e.target.matches(Y(t.params.pagination.bulletClass)))){if(t.navigation&&t.navigation.prevEl&&t.navigation.nextEl){const l=o(t.navigation.prevEl);o(t.navigation.nextEl).includes(s)&&(t.isEnd&&!t.params.loop||t.slideNext(),t.isEnd?k(n.lastSlideMessage):k(n.nextSlideMessage)),l.includes(s)&&(t.isBeginning&&!t.params.loop||t.slidePrev(),t.isBeginning?k(n.firstSlideMessage):k(n.prevSlideMessage))}t.pagination&&s.matches(Y(t.params.pagination.bulletClass))&&s.click()}}function U(){if(t.params.loop||t.params.rewind||!t.navigation)return;const{nextEl:e,prevEl:n}=t.navigation;n&&(t.isBeginning?(V(n),B(n)):(R(n),E(n))),e&&(t.isEnd?(V(e),B(e)):(R(e),E(e)))}function $(){return t.pagination&&t.pagination.bullets&&t.pagination.bullets.length}function D(){return $()&&t.params.pagination.clickable}function G(){const e=t.params.a11y;$()&&t.pagination.bullets.forEach(n=>{t.params.pagination.clickable&&(E(n),t.params.pagination.renderBullet||(g(n,"button"),M(n,e.paginationBulletMessage.replace(/\{\{index\}\}/,ce(n)+1)))),n.matches(Y(t.params.pagination.bulletActiveClass))?n.setAttribute("aria-current","true"):n.removeAttribute("aria-current")})}const T=(e,n,s)=>{E(e),e.tagName!=="BUTTON"&&(g(e,"button"),e.addEventListener("keydown",b)),M(e,s),I(e,n)},N=e=>{m&&m!==e.target&&!m.contains(e.target)&&(i=!0),t.a11y.clicked=!0},F=()=>{i=!1,requestAnimationFrame(()=>{requestAnimationFrame(()=>{t.destroyed||(t.a11y.clicked=!1)})})},H=e=>{z=new Date().getTime()},S=e=>{if(t.a11y.clicked||!t.params.a11y.scrollOnFocus||new Date().getTime()-z<100)return;const n=e.target.closest(`.${t.params.slideClass}, swiper-slide`);if(!n||!t.slides.includes(n))return;m=n;const s=t.slides.indexOf(n)===t.activeIndex,l=t.params.watchSlidesProgress&&t.visibleSlides&&t.visibleSlides.includes(n);s||l||e.sourceCapabilities&&e.sourceCapabilities.firesTouchEvents||(t.isHorizontal()?t.el.scrollLeft=0:t.el.scrollTop=0,requestAnimationFrame(()=>{i||(t.params.loop?t.slideToLoop(parseInt(n.getAttribute("data-swiper-slide-index")),0):t.slideTo(t.slides.indexOf(n),0),i=!1)}))},j=()=>{const e=t.params.a11y;e.itemRoleDescriptionMessage&&a(t.slides,e.itemRoleDescriptionMessage),e.slideRole&&g(t.slides,e.slideRole);const n=t.slides.length;e.slideLabelMessage&&t.slides.forEach((s,l)=>{const w=t.params.loop?parseInt(s.getAttribute("data-swiper-slide-index"),10):l,x=e.slideLabelMessage.replace(/\{\{index\}\}/,w+1).replace(/\{\{slidesLength\}\}/,n);M(s,x)})},K=()=>{const e=t.params.a11y;t.el.append(f);const n=t.el;e.containerRoleDescriptionMessage&&a(n,e.containerRoleDescriptionMessage),e.containerMessage&&M(n,e.containerMessage),e.containerRole&&g(n,e.containerRole);const s=t.wrapperEl,l=e.id||s.getAttribute("id")||`swiper-wrapper-${P(16)}`,w=t.params.autoplay&&t.params.autoplay.enabled?"off":"polite";q(s,l),O(s,w),j();let{nextEl:x,prevEl:C}=t.navigation?t.navigation:{};x=o(x),C=o(C),x&&x.forEach(A=>T(A,l,e.nextSlideMessage)),C&&C.forEach(A=>T(A,l,e.prevSlideMessage)),D()&&o(t.pagination.el).forEach(se=>{se.addEventListener("keydown",b)}),te().addEventListener("visibilitychange",H),t.el.addEventListener("focus",S,!0),t.el.addEventListener("focus",S,!0),t.el.addEventListener("pointerdown",N,!0),t.el.addEventListener("pointerup",F,!0)};function W(){f&&f.remove();let{nextEl:e,prevEl:n}=t.navigation?t.navigation:{};e=o(e),n=o(n),e&&e.forEach(l=>l.removeEventListener("keydown",b)),n&&n.forEach(l=>l.removeEventListener("keydown",b)),D()&&o(t.pagination.el).forEach(w=>{w.removeEventListener("keydown",b)}),te().removeEventListener("visibilitychange",H),t.el&&typeof t.el!="string"&&(t.el.removeEventListener("focus",S,!0),t.el.removeEventListener("pointerdown",N,!0),t.el.removeEventListener("pointerup",F,!0))}u("beforeInit",()=>{f=le("span",t.params.a11y.notificationClass),f.setAttribute("aria-live","assertive"),f.setAttribute("aria-atomic","true")}),u("afterInit",()=>{t.params.a11y.enabled&&K()}),u("slidesLengthChange snapGridLengthChange slidesGridLengthChange",()=>{t.params.a11y.enabled&&j()}),u("fromEdge toEdge afterInit lock unlock",()=>{t.params.a11y.enabled&&U()}),u("paginationUpdate",()=>{t.params.a11y.enabled&&G()}),u("destroy",()=>{t.params.a11y.enabled&&W()})}const ke={class:"flex flex-col"},Ee={class:"bg-white"},Me=["src"],Ce={class:"absolute top-2 left-2 flex items-center gap-2"},Ae={key:0,class:"px-1 py-0.5 bg-red-500 rounded-md text-white text-[16px] font-medium"},Le={class:"px-1 py-0.5 bg-primary rounded-md text-white text-[16px] font-medium"},Se={class:"bg-white p-2 flex flex-col items-start gap-2 col-span-2"},ze={class:"flex justify-between items-center w-full"},Pe={class:"flex justify-between items-center w-full"},Be={class:"flex items-center gap-2"},Ve={class:"text-primary text-base font-bold leading-normal"},Re={key:0,class:"text-slate-400 text-sm font-normal line-through leading-tight"},$e={key:0},De={class:"grid grid-cols-2 md:grid-cols-3 space-y-2 w-full"},Te={key:0,class:"flex items-center gap-1 ml-0 md:ml-2"},Ne={class:"text-slate-950 font-bold leading-tight flex items-center"},Fe={key:1,class:"flex items-center gap-1"},He={class:"flex items-center gap-1 text-slate-950 font-bold leading-tight"},je={key:2,class:"flex items-center gap-1"},Ie={class:"flex items-center text-slate-950 gap-2 font-bold leading-tight"},qe={key:3,class:"flex items-center gap-1"},Oe={class:"text-slate-950 font-bold leading-tight"},Ue={key:4,class:"flex items-center gap-2"},Ge={class:"text-slate-950 font-bold leading-tight"},Ke={class:"flex font-bold leading-tight flex items-center gap-2"},We={class:"w-full p-2"},Ze={key:0,class:"justify-start items-center gap-3 flex w-full"},Je={class:"text-primary text-sm font-normal flex justify-between gap-2 leading-tight"},Qe={__name:"ProductCard2",props:{product:Object},setup(v){var E,B;const t=de(),L=ue();pe();const u=fe(),f=ge(),i=v;(E=i.product)==null||E.id;const m=()=>{var a;const g=(a=i.product)==null?void 0:a.pdf_file;g?window.open(g,"_blank"):f.error("PDF file not available for this product.",{position:"bottom-left"})},z=ve((B=i.product)==null?void 0:B.is_favorite),k=()=>{if(u.token===null)return u.loginModal=!0;axios.post("/favorite-add-or-remove",{product_id:i.product.id},{headers:{Authorization:u.token}}).then(g=>{i.product.is_favorite=!i.product.is_favorite,z.value=g.data.data.product.is_favorite,z.value===!1?f.warning("Product removed from favorite",{position:"bottom-left"}):f.success("Product added to favorite",{position:"bottom-left"}),u.favoriteRemove=!0,u.fetchFavoriteProducts()})},P=()=>{i.product.quantity>0&&t.push({name:"productDetails",params:{id:i.product.id}})};return(g,a)=>{var I,M,q,O,V,R,b,U,$,D,G,T,N,F,H,S,j,K,W,e,n,s,l,w,x,C,X,A;return c(),d("div",{class:Z(["rounded-lg border transition-all mx-1 duration-300 group bg-white overflow-hidden relative",((I=i.product)==null?void 0:I.quantity)>0?"hover:border-primary":""])},[r("div",ke,[r("div",Ee,[r("div",{class:Z(["w-full h-36 sm:h-52 overflow-hidden relative",((M=i.product)==null?void 0:M.quantity)>0?"":"opacity-30"])},[r("div",{class:"cursor-pointer",onClick:P},[r("img",{src:(q=i.product)==null?void 0:q.thumbnail,loading:"lazy",class:"w-full h-full group-hover:scale-110 transition duration-500 object-cover"},null,8,Me)]),r("div",Ce,[(O=i.product)!=null&&O.is_special?(c(),d("div",Ae," 🔥"+p(g.$t("Special")),1)):h("",!0),r("div",Le,p(g.$t("Popular")),1)]),(V=i.product)!=null&&V.is_favorite?(c(),d("button",{key:0,class:"absolute top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center flex cursor-pointer bg-white",onClick:k},[_(y(me),{class:"w-6 h-6 text-red-500"})])):(c(),d("button",{key:1,class:"absolute flex sm:hidden group-hover:flex top-2 right-2 w-9 h-9 rounded-[10px] justify-center items-center cursor-pointer bg-white transition-all duration-300",onClick:k},[_(y(he),{class:"w-6 h-6 text-slate-600"})]))],2),r("div",{class:"cursor-pointer",onClick:P},[r("div",Se,[r("div",ze,[r("div",{class:Z(["text-slate-950 text-base font-normal leading-normal truncate w-full",((R=i.product)==null?void 0:R.quantity)>0?"":"opacity-30"])},p((b=i.product)==null?void 0:b.name)+" - "+p((U=i.product)==null?void 0:U.model),3),r("div",null,[($=i.product)!=null&&$.pdf_file?(c(),d("span",{key:0,class:"text-primary cursor-pointer",onClick:we(m,["stop"])},a[0]||(a[0]=[r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor",class:"size-6"},[r("path",{"fill-rule":"evenodd",d:"M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z","clip-rule":"evenodd"})],-1)]))):h("",!0)])]),r("div",{class:Z(["flex justify-between gap-2",((D=i.product)==null?void 0:D.quantity)>0?"":"opacity-30"])},null,2),r("div",Pe,[r("div",Be,[r("div",Ve,p(y(L).showCurrency(((G=i.product)==null?void 0:G.discount_price)>0?(T=i.product)==null?void 0:T.discount_price:(N=i.product)==null?void 0:N.price)),1),((F=i.product)==null?void 0:F.discount_price)>0?(c(),d("div",Re,p(y(L).showCurrency((H=i.product)==null?void 0:H.price)),1)):h("",!0)]),(S=i.product)!=null&&S.is_special?(c(),d("div",$e," 🔥 ")):h("",!0)]),r("div",De,[(j=i.product)!=null&&j.driving_range?(c(),d("div",Te,[r("div",Ne,[a[1]||(a[1]=xe('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="4" x2="5" y2="16"></line><line x1="5" y1="4" x2="14" y2="8"></line><line x1="5" y1="12" x2="14" y2="8"></line><ellipse cx="5" cy="18" rx="3" ry="2" fill="none"></ellipse></svg>',1)),J(" "+p((K=i.product)==null?void 0:K.driving_range)+" Km ",1)])])):h("",!0),(W=i.product)!=null&&W.battery_capacity?(c(),d("div",Fe,[r("div",He,[a[2]||(a[2]=r("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"currentColor",stroke:"currentColor","stroke-width":"0",version:"1.2",baseProfile:"tiny"},[r("path",{d:`\r
                                    M9 16\r
                                        c-.552 0-1-.447-1-1\r
                                        v-4\r
                                        c0-.553.448-1 1-1\r
                                        s1 .447 1 1\r
                                        v4\r
                                        c0 .553-.448 1-1 1\r
                                    z\r
\r
                                    M6 16\r
                                        c-.552 0-1-.447-1-1\r
                                        v-4\r
                                        c0-.553.448-1 1-1\r
                                        s1 .447 1 1\r
                                        v4\r
                                        c0 .553-.448 1-1 1\r
                                    z\r
\r
                                    M15 16\r
                                        c-.552 0-1-.447-1-1\r
                                        v-4\r
                                        c0-.553.448-1 1-1\r
                                        s1 .447 1 1\r
                                        v4\r
                                        c0 .553-.448 1-1 1\r
                                    z\r
\r
                                    M12 16\r
                                        c-.552 0-1-.447-1-1\r
                                        v-4\r
                                        c0-.553.448-1 1-1\r
                                        s1 .447 1 1\r
                                        v4\r
                                        c0 .553-.448 1-1 1\r
                                    z\r
\r
                                    M19 10\r
                                        c0-1.654-1.346-3-3-3\r
                                        h-11\r
                                        c-1.654 0-3 1.346-3 3\r
                                        v6\r
                                        c0 1.654 1.346 3 3 3\r
                                        h11\r
                                        c1.654 0 3-1.346 3-3\r
                                        1.104 0 2-.896 2-2\r
                                        v-2\r
                                        c0-1.104-.896-2-2-2\r
                                    z\r
\r
                                    m-2 6\r
                                        c0 .552-.449 1-1 1\r
                                        h-11\r
                                        c-.551 0-1-.448-1-1\r
                                        v-6\r
                                        c0-.552.449-1 1-1\r
                                        h11\r
                                        c.551 0 1 .448 1 1\r
                                        v6\r
                                    z\r
                                    `})],-1)),J(" "+p((e=i.product)==null?void 0:e.battery_capacity)+"kWh ",1)])])):h("",!0),(n=i.product)!=null&&n.year?(c(),d("div",je,[r("div",Ie,[a[3]||(a[3]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 448 512",width:"1em",height:"1em",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
                                        M0 464\r
                                            c0 26.5 21.5 48 48 48\r
                                            h352\r
                                            c26.5 0 48-21.5 48-48\r
                                            V192\r
                                            H0\r
                                            v272\r
                                            z\r
\r
                                        M320 268\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            h-40\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        m0 128\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            h-40\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        M192 268\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            h-40\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        m0 128\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            h-40\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        M64 268\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            H76\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        m0 128\r
                                            c0-6.6 5.4-12 12-12\r
                                            h40\r
                                            c6.6 0 12 5.4 12 12\r
                                            v40\r
                                            c0 6.6-5.4 12-12 12\r
                                            H76\r
                                            c-6.6 0-12-5.4-12-12\r
                                            v-40\r
                                            z\r
\r
                                        M400 64\r
                                            h-48\r
                                            V16\r
                                            c0-8.8-7.2-16-16-16\r
                                            h-32\r
                                            c-8.8 0-16 7.2-16 16\r
                                            v48\r
                                            H160\r
                                            V16\r
                                            c0-8.8-7.2-16-16-16\r
                                            h-32\r
                                            c-8.8 0-16 7.2-16 16\r
                                            v48\r
                                            H48\r
                                            C21.5 64 0 85.5 0 112\r
                                            v48\r
                                            h448\r
                                            v-48\r
                                            c0-26.5-21.5-48-48-48\r
                                            z\r
                                        `})],-1)),J(" "+p((s=i.product)==null?void 0:s.year),1)])])):h("",!0),(l=i.product)!=null&&l.peak_power?(c(),d("div",qe,[a[4]||(a[4]=r("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",viewBox:"0 0 24 24",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{fill:"none",d:"M0 0h24v24H0z"}),r("path",{d:`\r
                                    M11 21\r
                                        h-1\r
                                        l1-7\r
                                        H7.5\r
                                        c-.88 0-.33-.75-.31-.78\r
                                        C8.48 10.94 10.42 7.54 13.01 3\r
                                        h1\r
                                        l-1 7\r
                                        h3.51\r
                                        c.4 0 .62.19.4.66\r
                                        C12.97 17.55 11 21 11 21\r
                                    z\r
                                    `})],-1)),r("div",Oe,p((w=i.product)==null?void 0:w.peak_power)+" kW ",1)])):h("",!0),(x=i.product)!=null&&x.acceleration_time?(c(),d("div",Ue,[a[5]||(a[5]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
                                        M8 2\r
                                        a.5.5 0 0 1 .5.5\r
                                        V4\r
                                        a.5.5 0 0 1-1 0\r
                                        V2.5\r
                                        A.5.5 0 0 1 8 2\r
\r
                                        M3.732 3.732\r
                                        a.5.5 0 0 1 .707 0\r
                                        l.915.914\r
                                        a.5.5 0 1 1-.708.708\r
                                        l-.914-.915\r
                                        a.5.5 0 0 1 0-.707\r
\r
                                        M2 8\r
                                        a.5.5 0 0 1 .5-.5\r
                                        h1.586\r
                                        a.5.5 0 0 1 0 1\r
                                        H2.5\r
                                        A.5.5 0 0 1 2 8\r
\r
                                        m9.5 0\r
                                        a.5.5 0 0 1 .5-.5\r
                                        h1.5\r
                                        a.5.5 0 0 1 0 1\r
                                        H12\r
                                        a.5.5 0 0 1-.5-.5\r
\r
                                        m.754-4.246\r
                                        a.39.39 0 0 0-.527-.02\r
                                        L7.547 7.31\r
                                        A.91.91 0 1 0 8.85 8.569\r
                                        l3.434-4.297\r
                                        a.39.39 0 0 0-.029-.518\r
                                        z\r
                                        `}),r("path",{"fill-rule":"evenodd",d:`\r
                                        M6.664 15.889\r
                                        A8 8 0 1 1 9.336.11\r
                                        a8 8 0 0 1-2.672 15.78\r
                                        z\r
\r
                                        m-4.665-4.283\r
                                        A11.95 11.95 0 0 1 8 10\r
                                        c2.186 0 4.236.585 6.001 1.606\r
                                        a7 7 0 1 0-12.002 0\r
                                        `})],-1)),r("div",Ge,p((C=i.product)==null?void 0:C.acceleration_time)+" s ",1)])):h("",!0),r("div",Ke,[a[6]||(a[6]=r("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 576 512",width:"20",height:"20",fill:"currentColor",stroke:"currentColor","stroke-width":"0"},[r("path",{d:`\r
                                    M288 32\r
                                        c-80.8 0-145.5 36.8-192.6 80.6\r
                                        C48.6 156 17.3 208 2.5 243.7\r
                                        c-3.3 7.9-3.3 16.7 0 24.6\r
                                        C17.3 304 48.6 356 95.4 399.4\r
                                        C142.5 443.2 207.2 480 288 480\r
                                        s145.5-36.8 192.6-80.6\r
                                        c46.8-43.5 78.1-95.4 93-131.1\r
                                        c3.3-7.9 3.3-16.7 0-24.6\r
                                        c-14.9-35.7-46.2-87.7-93-131.1\r
                                        C433.5 68.8 368.8 32 288 32\r
                                    z\r
\r
                                    M144 256\r
                                        a144 144 0 1 1 288 0\r
                                        a144 144 0 1 1 -288 0\r
                                    z\r
\r
                                    m144-64\r
                                        c0 35.3-28.7 64-64 64\r
                                        c-7.1 0-13.9-1.2-20.3-3.3\r
                                        c-5.5-1.8-11.9 1.6-11.7 7.4\r
                                        c.3 6.9 1.3 13.8 3.2 20.7\r
                                        c13.7 51.2 66.4 81.6 117.6 67.9\r
                                        s81.6-66.4 67.9-117.6\r
                                        c-11.1-41.5-47.8-69.4-88.6-71.1\r
                                        c-5.8-.2-9.2 6.1-7.4 11.7\r
                                        c2.1 6.4 3.3 13.2 3.3 20.3\r
                                    z\r
                                    `})],-1)),J(" "+p((X=i.product)==null?void 0:X.visit_count),1)])])])])]),r("div",We,[((A=i.product)==null?void 0:A.quantity)>0?(c(),d("div",Ze,[r("button",{class:"justify-center items-center gap-0.5 flex border border-primary grow py-2.5 rounded-[10px]",onClick:P},[r("div",Je,[r("span",null,p(g.$t("Detail")),1),_(y(ie),{class:"w-4 h-4 text-primary"})])])])):h("",!0)])])],2)}}},Xe={class:"main-container py-12 bg-[#f3f5f7]"},Ye={class:"flex justify-between items-center gap-4"},et={class:"text-primary text-lg md:text-3xl font-bold leading-9"},tt={class:"text-[#343a40] text-base font-normal leading-normal"},nt={class:"mt-8"},lt={__name:"PopularProducts",props:{products:{type:Array,default:()=>[]},loading:{type:Boolean,default:!1}},setup(v){const t=[oe,_e],L={320:{slidesPerView:1,spaceBetween:20},768:{slidesPerView:2,spaceBetween:20},1024:{slidesPerView:3,spaceBetween:20},1400:{slidesPerView:4,spaceBetween:20}};return(u,f)=>{const i=ye("router-link");return c(),d("div",Xe,[r("div",Ye,[r("div",et,p(u.$t("Popular Products")),1),_(i,{to:"/popular-products",class:"flex items-center gap-1"},{default:Q(()=>[r("div",tt,p(u.$t("View All")),1),_(y(ie),{class:"w-5 h-5 text-[#343a40]"})]),_:1})]),r("div",nt,[_(y(ae),{navigation:!0,modules:t,breakpoints:L,class:"recentlyViewed",loop:!v.loading},{default:Q(()=>[v.loading?(c(),d(ne,{key:0},re(6,m=>_(y(ee),{key:`shimmer-${m}`},{default:Q(()=>f[0]||(f[0]=[r("div",{class:"bg-white shadow-md rounded-lg p-4 animate-pulse"},[r("div",{class:"h-60 bg-gray-200 rounded"}),r("div",{class:"mt-4 h-8 bg-gray-200 rounded"}),r("div",{class:"mt-2 h-8 bg-gray-200 rounded"}),r("div",{class:"mt-2 h-8 w-3/4 bg-gray-200 rounded"})],-1)])),_:2},1024)),64)):(c(!0),d(ne,{key:1},re(v.products,m=>(c(),be(y(ee),{key:m.id},{default:Q(()=>[_(Qe,{product:m},null,8,["product"])]),_:2},1024))),128))]),_:1},8,["loop"])])])}}};export{_e as A,lt as _,Y as c};
