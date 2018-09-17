
.hoverHero{
	z-index: 100;
	position: absolute;
	margin-left: -34px;
	margin-top: -20px;
}

.list-name:not(.main-list){
	display: none;
}

.searching, .inputName, #sender{
	height: 28px;
	width: 310px;
	background: #1e1e1e;
	outline: none;
	padding: 0 5px;
	color: #e8a902;
	text-shadow: 0 0 3px;
	box-shadow: 0 0 5px rgba(0,0,0,0.8);
	border: 1px solid #0f0f0f;
	margin-left: -1px;
}

.searching:focus, .inputName:focus{
	background-color: #272727;
	border-color: #333;
}
.active-select{
	background-color: #1e1e1e;
}









hr{
	margin: 0px;
	border: none;
	border-bottom: 1px solid #272727;
	border-top: 1px solid #070707;
}
#nameHero{
	text-transform: uppercase;
}
#formTitles{
	width: auto;
	padding: 0px;
	margin-top: 6px;
}
#formTitles input{
	background: #1e1e1e;
	border: 1px solid #272727;
	outline-color: #00bcff;
	color: #d4d5d5;
	height: 27px;
	margin: 3px 0px 3px 8px;
	width: 410px;
	font: 13px 'Comic Sans MS', cursive;
	text-align: center;
}
#formTitles input:focus{
	background: #272727;
}
#formTitles span{
	position: relative;
	top: 1px;
}
.activeHero{
	background-image: url('../images/resources/active_hero.png') !important;
	opacity: 1;
}
.activeHover{
	opacity: 0.3;
}

/**********New style sheet***********/




.active-contentItem{
	background-position: 0px -40px !important;
}


.contentForItem{
	width: 50px;
	height: 40px;
	display: inline-block;
	background-image: url('../images/resources/border_item_active.png');
	vertical-align: top;
}

#formConstruct{
	margin: 0;
}










.g-information{
	border-radius: 3px;
	padding: 5px ;
	text-align: center;
	position: relative;
}
.g-information p{
	color: #bbb;
	font-size: 19px;
}
.g-information .name{
	color: #e8a902;
	text-shadow: 0 0 10px;
}
.g-information .author a{
	color: #999 !important;
	text-decoration: none;
	text-shadow: 0 0 10px;
}
.g-information .author a:hover{
	color: #00bcff !important;
}
.g-information .dt{
	font-size: 16px;
	margin-top: 2px;
	text-shadow: 0 0 5px;
	position: absolute;
	right: 10px;
}


.content-m .contentForItems .contentForItem{
	margin: 4px 1px -1px 3px;
}
.content-m .title{
	text-align: center;
	color: #bbb;
	border-bottom: 1px solid #333;
}
.content-m #_other{
	display: block;
}
.hideOrShow{
	width: 23px;
	height: 23px;
	position: absolute;
	background: url('../images/resources/hide.png') 0 0;
	right: 4px;
	top: 4px;
	cursor: pointer;
}
.content-info > div:last-child{
	margin-bottom: 0 !important;
}
.hideOrShow-active{
	background-position: 0 -23px;
}
.description .info{
	height: auto;
	font-size: 15px;
	color: #bbb;
}










.ui-tooltip{
	position:absolute;
	z-index:999;
	left:-9999px;
	border:1px solid #333;
	box-shadow: 4px 4px 6px rgba(0,0,0,0.8);
}
.ui-tooltip div{
	color:#777;
	background:url('../images/resources/content.png');
	padding:3px 6px;
	font: 15px Century Gothic;
}






.foreword, .skilltextarea, .titleguide{
	outline: none;
	-moz-appearance: none;
	resize: none;
	border: none;
	width: 100%;
	background: none;
	font-family: Century Gothic;
	font-size: 15px;
	color: #bbb;
	height: 90px;
}
.skilltextarea{
	width: 708px;
	height: 47px;
	color: #999;
	font-size: 14px;
}
.activeArea{
	border-color: #1b1b1b !important;
	background-color: #1b1b1b !important;
}
.hoverArea{
	border-color: #333;
	background-color: #222;
}

.hoverPick{
	background-color: #333;
}
.pick-levels .levels{
	cursor: pointer;
}
.hovernumberpick{
	color: #bbb;
}
.activePick{
	background-color: #e8a902 !important;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
}
.activeNumber{
	color: #1e1e1e !important;
}
.titleguide{
	font-size: 16px;
	color: #999;
	height: 28px;
}
#nameguide .info{
	height: 28px;
}
#itembuild .title:hover{
	border-color: #333;
	background-color: #222;
}
#itembuild .title:focus{
	border-color: #1b1b1b !important;
	background-color: #1b1b1b !important;
	border-bottom-color: #272727 !important;
}
#itembuild .title{
	background: none;
	border: none;
	resize: none;
	font-family: Century Gothic;
	font-size: 16px;
	display: block;
	width: 100%;
	height: 25px;
	border-bottom: 1px solid #333;
	outline: none;
	text-align: center;
	color: #bbb;
}
#itembuild .title[name = _other]{
	cursor: pointer;
	border-bottom: none;
}
#itembuild #__other .ui-droppable{
	display: none;
}
#itembuild #__other{
	height: 22px;
}
#skillbuild > div{
	width: 763px;
	margin: 0 auto;
}
#skillbuild > div{
	border: 1px solid #272727;
	background-color: #1e1e1e;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
}
#itembuild .contentForItems{
	float: none;
	margin-left: 0;
	width: 758px;
	padding: 2px 3px 5px 2px;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
	margin: 5px auto;
}
#description .info{
	height: auto;
	font-size: 15px;
	color: #bbb;
}
#description .info, #nameguide .info{
	padding: 4px;
	width: 755px;
	margin: auto;
}
.ui-accordion-header-icon{
	width: 23px;
	height: 23px;
	position: absolute;
	background: url('../images/resources/hide.png') 0 -23px;
	right: 4px;
	top: 4px;
}
.icon-active{
	background-position: 0 0;
}




.contentitem-common-hover{
	background-position: 0px -84px;
}
.contentitem-main-hover{
	background-position: -53px -42px;
}


#senderguide{
	width: 775px;
	margin: 0 auto;
	text-transform: uppercase;
	font-size: 15px;
	text-align: left;
	padding: 5px 10px;
}





.inputclass{
	background-color: #1e1e1e;
	border: 1px solid #333;
	color: #777;
	padding: 3px 7px;
	font: 14px Century Gothic;
	outline: none;
	display: block;
}
.inputclass:hover{
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
	border-color: #272727;
}
.inputclass:active{
	background-color: #1a1a1a;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
	border-color: #272727;
}

.ui-droppable img{
	display: block;
}



.ready{
	width: 13px;
	height: 23px;
	display: inline-block;
	background: url('../images/resources/ready.png');
	margin-left: -5px;
}
.possible{
	float: right;
	margin: -28px 102px;
}
.active-ready{
	background-position: -13px 0;
}



.options{
	position: absolute;
	background: #222;
	color: #777;
	font: 14px Century Gothic;
	cursor: pointer;
	box-shadow: 0 0 10px rgba(0,0,0,0.5);
	display: none;
}
.options div{
	padding: 5px;
	border: 1px solid #333;
	margin-bottom: -1px;
	text-align: center;
	position: relative;
}
.options div:hover{
	border-color: #666;
	z-index: 10;
	background-color: #1e1e1e;
	color: #00bcff;
	box-shadow: inset 0 0 10px rgba(58, 60, 83, 0.5);
}





.guide:not(:last-child){
	margin-bottom: 5px;
}
.guide{
	border: 1px solid #272727;
	font-size: 15px;
}
.guide:nth-child(2n + 1){
	background-color: #1e1e1e;
}
.guide:nth-child(2n){
	background-color: #202020;
}
.guide #hero{
	color: #999;
}
.guide #name{
	color: #00bcff;
}
.guide #author{
	text-align: center;
}
.guide #date{
	color: #bbb;
	text-indent: 11px;
	cursor: default;
}
.guide #rating{
	color: #777;
	padding: 3px 0px;
	width: 12%;
	height: 21px;
	cursor: default;
}
.guide #looks{
	cursor: default;
	width: 9%;
	text-align: center;
	color: #999;
}

.guide #name:hover{
	color: #e8a902;
}
.guide #hero:hover{
	color: #bbb;
}
.guide:hover{
	background-color: #272727;
	border-color: #333;
	box-shadow: 0 0 10px rgba(8, 10, 10, 0.5);
}




#personalGuid #rating, #personalGuid #lookrating{
	position: absolute;
	left: 10px;
	cursor: pointer;
}
#personalGuid #rating{
	margin-left: 2px;
}











#setting span{
	display: inline-block;
	height: 29px;
	width: 29px;
	background-image: url('../images/resources/setting.png');
}
#setting{
	padding: 0px;
	width: 140px;
	text-align: center;
}
#delete{
	margin-left: 5px;
}
#edit:hover{
	background-position: -29px -29px;
}
#edit{
	background-position: 0px -29px;
}
#delete:hover{
	background-position: -29px 0px;
}





#rating .star{
	display: inline-block;
	width: 22px;
	height: 21px;
	background-image: url('../images/resources/rating.png');
	background-position: 0 -21px;
	position: relative;
	margin-right: -5px;
	cursor: pointer;
}
.stars_show, .stars_active{
	height: 21px;
	margin-left: 2px;
	position: absolute;
	background-image: url('../images/resources/show_rating.png');
}
.stars_active, .starsactive{
	background-position: 0 0 !important;
}
.stars_show{
	background-position: 0 -21px;
	width: 110px;
}
#lookrating{cursor: default !important;}


#nongold{
	display: none;
}