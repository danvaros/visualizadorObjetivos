var estados = [
['x','1990-01-01','1991-01-01','1992-01-01','1993-01-01','1994-01-01','1995-01-01','1996-01-01','1997-01-01','1998-01-01','1999-01-01','2000-01-01','2001-01-01','2002-01-01','2003-01-01','2004-01-01','2005-01-01','2006-01-01','2007-01-01','2008-01-01','2009-01-01','2010-01-01','2011-01-01','2012-01-01','2013-01-01','2014-01-01','2015-01-01','2016-01-01'],
['Estados Unidos Mexicanos','0.93633790871966','0.846621577231218','0.966914621057995','0.967993082619204','0.988805381156786','0.988805381156786','0.988805381156786','0.988805381156786','0.980045890554438','0.989112199679129','0.994515242378811','1.00890193054174','1.0099704845864','1.02369249665717','1.03618174853982','1.03961667037007','1.04171725891214','1.06533180449734','1.06835319308648','1.06752318560551','1.04193904966221','1.0354860003247','1.01828222956109','1.01102950160881','1.0023340356537','0.999714573692752','1.00645193749308'],
['Aguascalientes','0.93088841823654','0.816252961170048','0.964130905938448','0.988171714081778','1.00301488599962','1.00301488599962','1.00301488599962','1.00301488599962','1.01602591424431','1.02442759782525','1.04172441461813','1.03848000548734','1.03452205389462','1.05777684739376','1.07197121151539','1.10022443090734','1.09363946633571','1.10875244937949','1.10275456515011','1.09195228748301','1.0446035757746','1.05886684770102','1.05256648113791','1.03033401499659','1.02764221293874','1.03187369675305','1.03182202196564'],
['Baja California','0.929658186616089','0.805387899308111','0.911492175785305','0.968079560492441','0.984463826804766','0.984463826804766','0.984463826804766','0.984463826804766','1.0043558000917','1.00294409761635','0.99202942979767','0.996068501366029','1.00576055828039','0.991126998819061','0.999306799145052','0.99828634160709','1.01753868828298','1.03065006454837','1.02469692808663','1.02218567183149','1.00663497019586','0.99708598051673','0.993494648824033','0.997918897317187','1.00604113300857','1.00718840744747','1.01747261050246'],
['Baja California Sur','0.875980302753967','0.862657643801907','0.997427468915249','0.979918032786885','1.00198072098244','1.00198072098244','1.00198072098244','1.00198072098244','1.00660233621127','0.982547569991516','0.972211451466977','0.989706064740171','0.977853277966528','0.990911386013633','0.965323336457357','0.961036110196466','0.983045558560433','1.02219883264759','0.998707891093678','1.01184387617766','0.992200746015598','0.98187430742441','0.969753827679376','0.973965430682063','0.983703703703704','1.00872852233677','1.0294545935928'],
['Campeche','0.829183863666622','0.783001587495421','0.834820380370979','0.830939226519337','0.793297210515754','0.793297210515754','0.793297210515754','0.793297210515754','0.840613026819923','0.834051724137931','0.853034861086533','0.868350949557446','0.888729542770373','0.911552795031056','0.938196078431373','0.951177311366885','0.966313207819375','0.999294632150667','1.00149455554765','0.999369659616193','0.98510090749018','0.952191754054582','0.941843522331327','0.952003898160556','0.954567050718613','0.953444737613603','0.951799049558724'],
['Coahuila de Zaragoza','0.807684355616816','0.760015710919089','0.866087374639374','0.879883381924198','0.903303650329685','0.903303650329685','0.903303650329685','0.903303650329685','0.914650271056459','0.921916816221152','0.920612470790801','0.992621475704859','1.00286829499083','1.00733622946575','1.01613627434473','1.00031868277785','1.01782865963468','0.986356793375988','0.991959913449493','0.983534409143658','0.948213350099549','0.981330770489122','0.98035615572929','0.975875788452208','0.965009661652711','0.963612974363687','0.957535372914454'],
['Colima','1.06643822577575','0.814070351758794','1.04698103358274','1.05379090183559','1.08447966507177','1.08447966507177','1.08447966507177','1.08447966507177','1.0782252559727','1.07702576425043','1.03472222222222','1.0254660655538','1.0335409678965','1.07078787878788','1.10952550838387','1.11104873119245','1.11313868613139','1.11139816058696','1.10308424756779','1.06537904394013','1.04052453468697','1.06252524436546','1.08279595573601','1.05394852179457','1.06709696787751','0.958867978329056','0.982734710858411'],
['Chiapas','0.698950343157045','0.658220062734486','0.651691574218392','0.653042291950887','0.746966711604273','0.746966711604273','0.746966711604273','0.746966711604273','0.764769355273806','0.747552195059788','0.748825774255101','0.792326834595485','0.788322185061315','0.839078729489688','0.839347784870126','0.920811820197301','0.883630795083411','0.977251706122041','0.987110620703035','0.973515380819214','0.940397785703346','0.931737328076381','0.906827420546933','0.905747527125365','0.893181345425802','0.878825451828252','0.881144808521018'],
['Chihuahua','1.04474641148325','0.942261020755605','0.981775733500592','1.02155018878678','1.04341342170671','1.04341342170671','1.04341342170671','1.04341342170671','1.02377437894538','1.03460827193472','1.03751980211778','1.03698189455773','1.05239929590041','1.05999901681251','1.05980389884333','1.04511423776946','1.03907070787163','1.07775158658205','1.06596438860158','1.05958596456334','1.04038510829168','1.03987871283199','1.03364421632449','1.04597806215722','1.04512706029022','1.0558254806144','1.06935321043825'],
['Ciudad de México','0.899181596783024','0.821164405318328','0.941035358430582','0.934932446933285','0.991529460494978','0.991529460494978','0.991529460494978','0.991529460494978','0.937273836043101','0.973944915396535','0.983854048331504','0.980020374441287','0.990755165728183','1.00254758359417','0.981052906041921','0.983219614751944','0.953093989750881','0.969682361644751','0.966175352021223','0.983819557881237','0.970368600005411','0.967367199179776','0.962170456629789','0.958195517182332','0.959007343501258','0.960680379746835','0.96622269446439'],
['Durango','1.16247261531174','1.07359644246804','1.12485072844519','1.0805034965035','1.06731465205253','1.06731465205253','1.06731465205253','1.06731465205253','1.05426917510854','1.0037560760053','0.993875278396437','1.02199452345199','1.03767931723261','1.06801462291827','1.07534927981314','1.0815202091293','1.08878647063305','1.09851654621529','1.10421337973963','1.07575952626159','1.05624398273238','1.04939755323411','1.01401842744899','0.989315675618636','0.963313550196579','1.02779730815589','1.0289386687719'],
['Guanajuato','0.906299187305258','0.771345407503234','0.963641292887912','0.925958546180494','0.945054945054945','0.945054945054945','0.945054945054945','0.945054945054945','0.943513101617423','0.960512153556373','1.02045098122324','1.08583379153248','1.0801968468058','1.1046380385143','1.12794969386067','1.11827669674012','1.11121001810501','1.14558876227335','1.14349495236741','1.13732722629808','1.09088286208886','1.06983976261128','1.03801744735234','1.02613313307944','1.01086767182147','1.03057507774534','1.03655666637176'],
['Guerrero','1.00074243642888','0.916727827019703','1.01150468384075','1.01267885752168','1.03157376780296','1.03157376780296','1.03157376780296','1.03157376780296','1.00634453354989','1.04158050773562','1.05163859967857','1.06318430122148','1.068309405485','1.10473867595819','1.13853735556566','1.08923948942248','1.10525087514586','1.113542174549','1.14653858201942','1.12876549289994','1.08913219476464','1.08205493461904','1.04227179297099','1.03616428594565','1.02035402422271','1.0180911158389','1.0239002081357'],
['Hidalgo','0.92295074057992','0.877221779299348','0.949581018736465','0.957986870897155','0.961497982810033','0.961497982810033','0.961497982810033','0.961497982810033','0.965105312794719','0.968641362185172','0.993065326633166','1.03836860925872','1.04986933797909','1.06086826347305','1.05754207151457','1.065615986815','1.08179016091061','1.08927708196001','1.10492663155385','1.09827614992904','1.07855289994258','1.05412922145492','1.036770510161','1.01848287170713','0.999432511908652','0.996487919092062','0.992597048072919'],
['Jalisco','0.885113702363401','0.876356720777016','0.973209420151111','0.974244824384115','1.01966340374377','1.01966340374377','1.01966340374377','1.01966340374377','1.06749011857708','1.06364708330443','1.02749197990823','1.02305387763055','1.04676985195155','1.05216300798771','1.10794996671455','1.10579407458445','1.10151873521723','1.13622892678424','1.14008772352629','1.14592738774296','1.11655118373672','1.09939237556184','1.07968513184311','1.08027488942799','1.05504292145514','1.04293821977961','1.05405873458866'],
['México','0.903560007666778','0.732248014392909','0.913581603134498','0.927990566449753','0.959427207637232','0.959427207637232','0.959427207637232','0.959427207637232','0.947141751080715','0.988074917758053','1.00921322658034','1.04840804820076','1.04676417577573','1.05259494929409','1.06301400376325','1.06523859605146','1.07310252926147','1.10486468001026','1.11153207198892','1.1088775433124','1.09011013975717','1.08408937967715','1.06688060369139','1.05565545221708','1.03871097553527','1.02934698108318','1.04021877644564'],
['Michoacán de Ocampo','0.979143798024149','0.754400349841478','1.03089460560725','1.02311435523114','1.03479070786763','1.03479070786763','1.03479070786763','1.03479070786763','1.0341411783863','1.01972574613185','1.05742158869765','1.07553487896526','0.99426809773921','1.05483580106302','1.11968297664506','1.13337238426113','1.15660503016532','1.17638686197143','1.16557417274257','1.16557417274257','1.10388648372813','1.09794655764717','1.08294229913757','1.05993058738786','1.05763736786973','1.05551482140987','1.06285160497329'],
['Morelos','1.01843034003697','0.907922798037961','1.02785848572894','1.06191155492154','1.02702255556168','1.02702255556168','1.02702255556168','1.02702255556168','1.03130452632659','1.05092658758516','1.05849116304299','1.06416948111759','1.0889590451066','1.10216887765845','1.1031746031746','1.13178350367065','1.13204391008887','1.12027985745578','1.13024838825801','1.12718951666008','1.10280022552152','1.09137848222863','1.07717977239668','1.06235914990729','1.04974479238516','1.04659012385053','1.03369275532409'],
['Nayarit','1.54036553524804','1.36407898295916','1.48117272386662','1.3863070182974','1.31808715155399','1.31808715155399','1.31808715155399','1.31808715155399','1.27956989247312','1.242183058556','1.24175980636435','1.22147324530924','1.22704424778761','1.20455170517052','1.2067581130813','1.21687536877991','1.18683864504414','1.19810809182382','1.17896038146818','1.13360698387004','1.09404072085482','1.08448352080161','1.05085973724884','1.0408746540852','1.02575941676792','1.03150090119613','1.05239478097264'],
['Nuevo León','1.12101288316304','1.0664681506778','1.16629630428685','1.06354322305229','1.0245304091786','1.0245304091786','1.0245304091786','1.0245304091786','1.01266243282853','1.00895935044709','0.992541653836943','0.98229590654886','0.947804918996055','0.951600530023014','0.96270713532274','0.939182109881475','0.93174899036968','0.932722866389006','0.915557965272275','0.931724411531341','0.903186800327651','0.911061981227213','0.877540815561167','0.887314927867803','0.905450158759062','0.898833876649091','0.921043965965945'],
['Oaxaca','0.874975934696392','0.824521934758155','0.906686919598163','0.934250054198024','0.940395314378372','0.940395314378372','0.940395314378372','0.940395314378372','0.910258410024437','0.956978791621771','0.953259025926823','0.965322446654482','0.981075121491726','0.994547800391227','1.02283412979806','1.0339756682355','1.04517327759253','1.06770044166479','1.11074971540088','1.10956041728391','1.08036391205459','1.07502050985993','1.05326382260078','1.02967927237913','1.01888640783692','1.00759796091287','1.00587363526357'],
['Puebla','1.02271789292012','1.03028111379684','1.09757936346224','1.08103180358438','1.05099114823588','1.05099114823588','1.05099114823588','1.05099114823588','1.04029118654625','1.04676665936793','1.05610451967572','1.07056151873091','1.0561549400272','1.07774224643114','1.09052276008608','1.08618702873318','1.09747271550129','1.13676943943964','1.13669500014878','1.13851924708787','1.11586338676165','1.10089936145337','1.07179736888501','1.05609633636746','1.04483194852252','1.03537004506225','1.03142623413667'],
['Querétaro','0.900218389939001','0.882674886763966','0.930676249591637','1.07483411998085','1.1149498827042','1.1149498827042','1.1149498827042','1.1149498827042','1.15375318920371','1.11851138915624','1.07562226866806','1.06410256410256','1.07471015277928','1.08474322503369','1.13817275122318','1.09660115398485','1.11748915961181','1.13789133583392','1.15337740517783','1.14342322509631','1.11301475900506','1.08862591246744','1.06724227354547','1.06221123569053','1.04500913469523','1.04326140328208','1.06259711431743'],
['Quintana Roo','0.727033056175218','0.499865663621709','0.776296725586786','0.807466297960595','0.84328611898017','0.84328611898017','0.84328611898017','0.84328611898017','0.861187118501368','0.894179894179894','0.920222634508349','0.947396963123644','0.965186718809907','0.966570732787248','0.951290760869565','1.01278061055559','0.993627566674534','0.977165622115338','0.992056362002932','1.01287335031257','0.996617238183503','0.978261814703709','0.994917252876835','0.998058622002284','0.978292329956585','0.963436123348018','0.978879769222844'],
['San Luis Potosí','0.87957553995391','0.74033422327697','0.912440241114113','0.926841349249591','0.920550994851816','0.920550994851816','0.920550994851816','0.920550994851816','0.948998964445979','0.963212057369743','0.971571383942518','1.00823636088862','1.01558605810363','1.00241641721066','1.0271549656165','1.0341653759085','1.05152956795929','1.08081266384352','1.08330230595477','1.09216232586311','1.05817939221054','1.04418387103792','1.02441120500911','1.01974424963809','1.01156837080382','1.00225922199229','1.01558004857089'],
['Sinaloa','1.0994205336698','0.992227365701367','1.11671757653706','1.12901368222232','1.12379101709137','1.12379101709137','1.12379101709137','1.12379101709137','1.12323266840374','1.13461165153247','1.10818305098468','1.09860881289453','1.09333630668802','1.08027330405076','1.09931640625','1.08931794254775','1.09735183782086','1.07434691338828','1.08641762121299','1.05666293393057','1.0322698173112','1.04159335042649','1.02393250136345','1.02619721427329','1.01691232603206','1.02219647264191','1.02559509711037'],
['Sonora','0.990535541706935','0.861405733015863','1.137065454201','1.10039059005933','1.11649921116001','1.11649921116001','1.11649921116001','1.11649921116001','1.12532988938177','1.09624562519885','1.0940851651269','1.07660636627982','1.05383107127397','1.04695087665491','1.05429149597749','1.03102768698327','1.0404643371163','1.03632962922214','1.03905367527089','1.05687353418726','1.01981623406868','1.01832505566022','1.00549765840475','1.0078322385043','1.02761524580303','1.02185067232838','1.03546013121811'],
['Tabasco','0.903435631029816','0.853868641590333','0.909114651344999','0.910039560165717','0.928275528408576','0.928275528408576','0.928275528408576','0.928275528408576','0.952495473064735','0.935404900986499','0.950550415005391','0.960840496657116','0.946205066586563','0.945071041453054','0.968044311887516','0.982948294829483','1.00286695943025','1.00899190292237','1.00909052737655','1.01230871590153','0.990587616136672','0.974677380082785','0.95716527924026','0.947597994710457','0.930251434976712','0.923935564556773','0.938829215896885'],
['Tamaulipas','0.833460608374698','0.742888933268666','0.872213424290413','0.896595169319648','0.910579966892226','0.910579966892226','0.910579966892226','0.910579966892226','0.920265211054271','0.929772338900832','0.944743749136621','0.964654717975751','0.965928362197441','0.978232683389019','0.991500972914943','0.998812607944732','1.01751595645798','1.04722589167768','1.04235047056078','1.03593339176161','1.018663209859','1.02610886067332','1.01714662563201','0.992119636746512','0.995701823949247','0.988852499346526','0.999124994531216'],
['Tlaxcala','1.04872898562495','0.98658434331885','1.0449316760596','1.06047680706832','1.03330661030537','1.03330661030537','1.03330661030537','1.03330661030537','1.03118370810352','0.985544554455446','0.982327963032347','0.993450449899002','1.01060560409762','1.03350253807107','1.03891699241205','1.03165776578759','1.03746854829887','1.05285132382892','1.0564950038432','1.07329210551744','1.05993676396462','1.06633096023615','1.02855389650235','1.0095373065727','1.00865312264861','0.993833017077799','0.991681455190772'],
['Veracruz de Ignacio de la Llave','0.913334911662869','0.833125033961854','0.917841805942433','0.954849340230413','0.982977817302754','0.982977817302754','0.982977817302754','0.982977817302754','0.955632792544816','0.9530258054731','0.96629646607768','0.976275848018743','0.986827267071084','1.0101496244833','1.02097567263955','1.02274790456633','1.04281670498975','1.08249739372177','1.08916081240339','1.08338630584817','1.05953125931224','1.04914832421799','1.03466753917185','1.02586244055231','1.00161019322319','0.995592424479574','0.994554437592412'],
['Yucatán','0.741836069460084','0.632248939179632','0.792145153881488','0.810773783428321','0.819494054900426','0.819494054900426','0.819494054900426','0.819494054900426','0.81729236762883','0.838368890533152','0.867041729064638','0.888339168823261','0.888626101913567','0.899138228197173','0.930687516495117','0.939386286147241','0.951463650659248','0.974549026611895','0.994699433803156','0.994224350602235','0.97786519655373','0.960248480324198','0.947001503135852','0.947975349784443','0.95043968766165','0.964470941786632','0.974781125639568'],
['Zacatecas','0.93716823746073','0.877428689541133','0.996785857774206','1.02040625292521','1.0056223510077','1.0056223510077','1.0056223510077','1.0056223510077','1.05825085185786','1.03737094663371','1.02343536485379','1.04824944560177','1.0588959440197','1.08338666325355','1.12930705657978','1.15400138376384','1.16420229293903','1.1843910806175','1.1628155655772','1.12646752187118','1.09666912754592','1.07526545908807','1.04475897587906','1.04487202498474','1.04003439380911','1.05628216474907','1.05532172693068'],
]



// 
// =CONCATENAR(
// CARACTER(91),
//   CARACTER(39),A1,CARACTER(39),CARACTER(44),
//   CARACTER(39),B1,CARACTER(39),CARACTER(44),
//   CARACTER(39),C1,CARACTER(39),CARACTER(44),
//   CARACTER(39),D1,CARACTER(39),CARACTER(44),
//   CARACTER(39),E1,CARACTER(39),CARACTER(44),
//   CARACTER(39),F1,CARACTER(39),CARACTER(44),
//   CARACTER(39),F1,CARACTER(39),CARACTER(44),
//   CARACTER(39),F1,CARACTER(39),CARACTER(44),
//   CARACTER(39),F1,CARACTER(39),CARACTER(44),
//   CARACTER(39),g1,CARACTER(39),CARACTER(44),
//   CARACTER(39),H1,CARACTER(39),CARACTER(44),
//   CARACTER(39),i1,CARACTER(39),CARACTER(44),
//   CARACTER(39),j1,CARACTER(39),CARACTER(44),
//   CARACTER(39),k1,CARACTER(39),CARACTER(44),
//   CARACTER(39),l1,CARACTER(39),CARACTER(44),
//   CARACTER(39),m1,CARACTER(39),CARACTER(44),
//   CARACTER(39),n1,CARACTER(39),CARACTER(44),
//   CARACTER(39),o1,CARACTER(39),CARACTER(44),
//   CARACTER(39),r1,CARACTER(39),CARACTER(44),
//   CARACTER(39),s1,CARACTER(39),CARACTER(44),
//   CARACTER(39),t1,CARACTER(39),CARACTER(44),
//   CARACTER(39),u1,CARACTER(39),CARACTER(44),
//   CARACTER(39),v1,CARACTER(39),CARACTER(44),
//   CARACTER(39),w1,CARACTER(39),CARACTER(44),
//   CARACTER(39),x1,CARACTER(39),CARACTER(44),
//   CARACTER(39),y1,CARACTER(39),CARACTER(44),
//   CARACTER(39),z1,CARACTER(39),CARACTER(44),
//   CARACTER(39),aa1,CARACTER(39),CARACTER(44),
// CARACTER(93))
