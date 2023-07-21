/* Create the database and use it */
CREATE DATABASE IF NOT EXISTS LisaVNCNT_personal_blog;
USE LisaVNCNT_personal_blog;

/* Create all tables for the database */
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(100) NOT NULL,
    chapo TEXT NOT NULL,
    content TEXT NOT NULL,
    author INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author) REFERENCES users(id)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    content TEXT NOT NULL,
    author INT NOT NULL,
    status ENUM('pending', 'accepted', 'deleted') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author) REFERENCES users(id)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tags (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(50) NOT NULL,
    badge VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=INNODB;

/* Create the pivot tables */
CREATE TABLE IF NOT EXISTS comment_post (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    comment_id INT NOT NULL,
    post_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS post_tag (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    post_id INT NOT NULL,
    tag_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

/* Create the first entries into tables */
INSERT INTO users (id, firstname, lastname, email, password, isAdmin)
VALUES 
('1', 'Lisa', 'VINCENT', 'lisa.vincent31150@gmail.com', '$2y$10$P5CSolEkfZKiFWfKM6hEhu/D.CPo2o2gedF0DlZfdvG62DHkvduOa', 1),
('2', 'Davy', 'BOUTCHOKI', 'dboutchou@gmail.com', '$2y$10$xgdhhWNRq9HkOOBDf1bnmOgcf/4mCMESkhu3dWtstyz3FQuMU594.', 1),
('3', 'Florian', 'FRATELLI', 'florian.fratelli@example-mail.com', '$2y$10$JwAbAoiK5rd0XmXhN1NZmufuh4UcoG59NZGIhy7X6KVqzUU1ElUa2', 0),
('4', 'Cristina', 'BAZ BARBEIRO', 'cristina.bazbarbeiro@example-mail.com', '$2y$10$/XMShLGKjM66U9VIjWX5xeii.X2bJvCsX.GJq2gHK6cy.9fjWcbB2', 0),
('5', 'Tom', 'DEVINCENZO', 'tom.devincenzo@example-mail.com', '$2y$10$Xs2hwhBDC3RIgKotehhz2eiGeed5xATMsojVrQQ56hGYHizJbgYBa', 0),
('6', 'Anaïs', 'JUSTIAZ', 'anais.justiaz@example-mail.com', '$2y$10$XXCrz.Vf26sO/Gkj4FD.XOaZNjlUP8ttvRhJk4/S1OUYHof9RWEli', 0);

INSERT INTO posts (id, title, chapo, content, author, created_at, updated_at)
VALUES 
('1', 'Aperta id ab omni quieti.', 'Non diffusa planitiem Antiochia copiis Laodicia iam inde per florentissimae Seleucia Seleucia interpatet primis nobilitat.', 'Etenim si attendere diligenter, existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum quemquam ad hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum spei fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino, humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel pietatis vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est resistendum.<br>Ut enim quisque sibi plurimum confidit et ut quisque maxime virtute et sapientia sic munitus est, ut nullo egeat suaque omnia in se ipso posita iudicet, ita in amicitiis expetendis colendisque maxime excellit. Quid enim? Africanus indigens mei? Minime hercule! ac ne ego quidem illius; sed ego admiratione quadam virtutis eius, ille vicissim opinione fortasse non nulla, quam de meis moribus habebat, me dilexit; auxit benevolentiam consuetudo. Sed quamquam utilitates multae et magnae consecutae sunt, non sunt tamen ab earum spe causae diligendi profectae.<br>Etenim si attendere diligenter, existimare vere de omni hac causa volueritis, sic constituetis, iudices, nec descensurum quemquam ad hanc accusationem fuisse, cui, utrum vellet, liceret, nec, cum descendisset, quicquam habiturum spei fuisse, nisi alicuius intolerabili libidine et nimis acerbo odio niteretur. Sed ego Atratino, humanissimo atque optimo adulescenti meo necessario, ignosco, qui habet excusationem vel pietatis vel necessitatis vel aetatis. Si voluit accusare, pietati tribuo, si iussus est, necessitati, si speravit aliquid, pueritiae. Ceteris non modo nihil ignoscendum, sed etiam acriter est resistendum.', 1, '2023-04-20 08:34:56', '2023-04-20 08:34:56'),
('2', 'Largitionum uti et largitionum iussit.', 'Vincens quam primis vincens et et usque bella bellorum trecentis bella orbis pueritiae solo inmensus.', 'Utque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.<br>Primi igitur omnium statuuntur Epigonus et Eusebius ob nominum gentilitatem oppressi. praediximus enim Montium sub ipso vivendi termino his vocabulis appellatos fabricarum culpasse tribunos ut adminicula futurae molitioni pollicitos.<br>Vbi curarum abiectis ponderibus aliis tamquam nodum et codicem difficillimum Caesarem convellere nisu valido cogitabat, eique deliberanti cum proximis clandestinis conloquiis et nocturnis qua vi, quibusve commentis id fieret, antequam effundendis rebus pertinacius incumberet confidentia, acciri mollioribus scriptis per simulationem tractatus publici nimis urgentis eundem placuerat Gallum, ut auxilio destitutus sine ullo interiret obstaculo.', 1, '2023-04-28 09:15:05', '2023-04-28 09:15:05'),
('3', 'Formidine iusserim iusserim per nos.', 'Malorum quaerebatur specie iusque tenus crimina perpensum quaerebatur committerentur in quod Caesaris quod perpensum legum.', 'Illud autem non dubitatur quod cum esset aliquando virtutum omnium domicilium Roma, ingenuos advenas plerique nobilium, ut Homerici bacarum suavitate Lotophagi, humanitatis multiformibus officiis retentabant.<br>Post haec Gallus Hierapolim profecturus ut expeditioni specie tenus adesset, Antiochensi plebi suppliciter obsecranti ut inediae dispelleret metum, quae per multas difficilisque causas adfore iam sperabatur, non ut mos est principibus, quorum diffusa potestas localibus subinde medetur aerumnis, disponi quicquam statuit vel ex provinciis alimenta transferri conterminis, sed consularem Syriae Theophilum prope adstantem ultima metuenti multitudini dedit id adsidue replicando quod invito rectore nullus egere poterit victu.<br>Omitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.', 1, '2023-05-04 10:14:26', '2023-05-04 10:14:26'),
('4', 'Multavit editos conperto idus terminabat.', 'Concepta matris tuebatur quam Seleuciae saeviore urbium rabie sudoribus matris fames tresque rabie rabie concepta.', 'Ideo urbs venerabilis post superbas efferatarum gentium cervices oppressas latasque leges fundamenta libertatis et retinacula sempiterna velut frugi parens et prudens et dives Caesaribus tamquam liberis suis regenda patrimonii iura permisit.<br>Sed (saepe enim redeo ad Scipionem, cuius omnis sermo erat de amicitia) querebatur, quod omnibus in rebus homines diligentiores essent; capras et oves quot quisque haberet, dicere posse, amicos quot haberet, non posse dicere et in illis quidem parandis adhibere curam, in amicis eligendis neglegentis esse nec habere quasi signa quaedam et notas, quibus eos qui ad amicitias essent idonei, iudicarent. Sunt igitur firmi et stabiles et constantes eligendi; cuius generis est magna penuria. Et iudicare difficile est sane nisi expertum; experiendum autem est in ipsa amicitia. Ita praecurrit amicitia iudicium tollitque experiendi potestatem.<br>Incenderat autem audaces usque ad insaniam homines ad haec, quae nefariis egere conatibus, Luscus quidam curator urbis subito visus: eosque ut heiulans baiolorum praecentor ad expediendum quod orsi sunt incitans vocibus crebris. qui haut longe postea ideo vivus exustus est.', 1, '2023-05-12 11:27:00', '2023-05-12 11:27:00'),
('5', 'Ita tenent eruditi igitur cetero.', 'Divulsa in velut civitatis scalas truncata velut iamque ampla per Domitianum ultimam eodem itidem acri.', 'Erat autem diritatis eius hoc quoque indicium nec obscurum nec latens, quod ludicris cruentis delectabatur et in circo sex vel septem aliquotiens vetitis certaminibus pugilum vicissim se concidentium perfusorumque sanguine specie ut lucratus ingentia laetabatur.<br>Altera sententia est, quae definit amicitiam paribus officiis ac voluntatibus. Hoc quidem est nimis exigue et exiliter ad calculos vocare amicitiam, ut par sit ratio acceptorum et datorum. Divitior mihi et affluentior videtur esse vera amicitia nec observare restricte, ne plus reddat quam acceperit; neque enim verendum est, ne quid excidat, aut ne quid in terram defluat, aut ne plus aequo quid in amicitiam congeratur.<br>Equitis Romani autem esse filium criminis loco poni ab accusatoribus neque his iudicantibus oportuit neque defendentibus nobis. Nam quod de pietate dixistis, est quidem ista nostra existimatio, sed iudicium certe parentis; quid nos opinemur, audietis ex iuratis; quid parentes sentiant, lacrimae matris incredibilisque maeror, squalor patris et haec praesens maestitia, quam cernitis, luctusque declarat.', 1, '2023-06-14 12:44:16', '2023-06-14 12:44:16'),
('6', 'Pectoralem vexatus Christiani denique purpurae.', 'Fame plerumque confinia tum merces aliquando incendente nullis ait parcendo ut ut perpetrata degressi non.', 'Sed (saepe enim redeo ad Scipionem, cuius omnis sermo erat de amicitia) querebatur, quod omnibus in rebus homines diligentiores essent; capras et oves quot quisque haberet, dicere posse, amicos quot haberet, non posse dicere et in illis quidem parandis adhibere curam, in amicis eligendis neglegentis esse nec habere quasi signa quaedam et notas, quibus eos qui ad amicitias essent idonei, iudicarent. Sunt igitur firmi et stabiles et constantes eligendi; cuius generis est magna penuria. Et iudicare difficile est sane nisi expertum; experiendum autem est in ipsa amicitia. Ita praecurrit amicitia iudicium tollitque experiendi potestatem.<br>Alios autem dicere aiunt multo etiam inhumanius (quem locum breviter paulo ante perstrinxi) praesidii adiumentique causa, non benevolentiae neque caritatis, amicitias esse expetendas; itaque, ut quisque minimum firmitatis haberet minimumque virium, ita amicitias appetere maxime; ex eo fieri ut mulierculae magis amicitiarum praesidia quaerant quam viri et inopes quam opulenti et calamitosi quam ii qui putentur beati.<br>Sed tamen haec cum ita tutius observentur, quidam vigore artuum inminuto rogati ad nuptias ubi aurum dextris manibus cavatis offertur, inpigre vel usque Spoletium pergunt. haec nobilium sunt instituta.', 1, '2023-06-25 14:02:47', '2023-06-25 14:02:47'),
('7', 'Filius eo ex a redirent.', 'Augusti filio regi quam rumigerulos conpertis vel grave rumigerulos suetos suetos eruditiores iunxerat accesserat regni.', 'Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita priscis.<br>Qui cum venisset ob haec festinatis itineribus Antiochiam, praestrictis palatii ianuis, contempto Caesare, quem videri decuerat, ad praetorium cum pompa sollemni perrexit morbosque diu causatus nec regiam introiit nec processit in publicum, sed abditus multa in eius moliebatur exitium addens quaedam relationibus supervacua, quas subinde dimittebat ad principem.<br>Advenit post multos Scudilo Scutariorum tribunus velamento subagrestis ingenii persuasionis opifex callidus. qui eum adulabili sermone seriis admixto solus omnium proficisci pellexit vultu adsimulato saepius replicando quod flagrantibus votis eum videre frater cuperet patruelis, siquid per inprudentiam gestum est remissurus ut mitis et clemens, participemque eum suae maiestatis adscisceret, futurum laborum quoque socium, quos Arctoae provinciae diu fessae poscebant.', 1, '2023-07-02 13:45:16', '2023-07-02 13:45:16'),
('8', 'Potius ad coniugem reducere autem.', 'Ad cum praecipites adseclae ut disciplinarum dudum est indignitatis tenerentur ab pellerentur ut veri minimarum.', 'Haec igitur Epicuri non probo, inquam. De cetero vellem equidem aut ipse doctrinis fuisset instructior est enim, quod tibi ita videri necesse est, non satis politus iis artibus, quas qui tenent, eruditi appellantur aut ne deterruisset alios a studiis. quamquam te quidem video minime esse deterritum.<br>Exsistit autem hoc loco quaedam quaestio subdifficilis, num quando amici novi, digni amicitia, veteribus sint anteponendi, ut equis vetulis teneros anteponere solemus. Indigna homine dubitatio! Non enim debent esse amicitiarum sicut aliarum rerum satietates; veterrima quaeque, ut ea vina, quae vetustatem ferunt, esse debet suavissima; verumque illud est, quod dicitur, multos modios salis simul edendos esse, ut amicitiae munus expletum sit.<br>Oportunum est, ut arbitror, explanare nunc causam, quae ad exitium praecipitem Aginatium inpulit iam inde a priscis maioribus nobilem, ut locuta est pertinacior fama. nec enim super hoc ulla documentorum rata est fides.', 1, '2023-07-20 15:00:45', '2023-07-20 15:00:45');

INSERT INTO comments (id, content, author, status, created_at, updated_at)
VALUES 
('1', 'Liberis aerario stipe Valerius amicorum Scipionis Valerius filia Reguli Reguli.', 3, 'accepted', '2023-06-07 08:20:00', '2023-06-07 08:20:00'),
('2', 'Erigens adfectans evibrabat respectu ea incitationem ad suae idque evibrabat.', 4, 'accepted', '2023-06-12 08:54:52', '2023-06-12 08:54:52'),
('3', 'Superatis augente nimia nimia arbitrabantur nullo augente per verticosi lucem.', 5, 'accepted', '2023-07-01 09:47:21', '2023-07-01 09:47:21'),
('4', 'Iam internis copiis Apamia et et ita et speciosam iam non Seleucia inde non auspiciis.', 6, 'deleted', '2023-07-02 06:04:41', '2023-07-02 06:04:41'),
('5', 'Non facere publicae rei propter senator hac etiamsi ille ille propter rei rei tam ut.', 3, 'accepted', '2023-07-02 10:44:01', '2023-07-02 10:44:01'),
('6', 'Interclusum impetus et bellisque atque quis vero et affervescentem armatum.', 4, 'accepted', '2023-07-02 12:08:35', '2023-07-02 12:08:35'),
('7', 'Iussisse illo intepescit vitium hoc hoc quoque similia propositum in.', 5, 'deleted', '2023-07-02 12:11:00', '2023-07-02 12:11:00'),
('8', 'Quidem solet ad et nominata benevolentiam illud nihil natura id.', 6, 'accepted', '2023-07-02 16:57:03', '2023-07-02 16:57:03'),
('9', 'Perfidia quandoque bella diutius supra perfidia regis per generalibus in.', 3, 'accepted', '2023-07-14 10:44:01', '2023-07-14 10:44:01'),
('10', 'Dissentientium dissentientium ludus philosophia quo dissentientium pacto pertinaces quid maledicta.', 4, 'deleted', '2023-07-14 12:08:35', '2023-07-14 12:08:35'),
('11', 'Ad forensium vulgus et usibus crebros efferens decuerat usibus crebros.', 5, 'accepted', '2023-07-15 12:11:00', '2023-07-15 12:11:00'),
('12', 'Qui textum tunc civitatibus locante qui incertum civitatibus occulte multi.', 6, 'accepted', '2023-07-16 16:57:03', '2023-07-16 16:57:03'),
('13', 'Feminea in in autem quae truculenti eum mariti autem abrupte.', 3, 'deleted', '2023-07-17 10:44:01', '2023-07-17 10:44:01'),
('14', 'Patriae ne patriae sit ne potius curae concessum futurum coepit.', 4, 'accepted', '2023-07-17 12:08:35', '2023-07-17 12:08:35'),
('15', 'Tuniculam nihil usque nomine sermone Tyrii textam denique textrini usque.', 5, 'accepted', '2023-07-17 12:11:00', '2023-07-17 12:11:00'),
('16', 'Fuisset probo deterruisset instructior cetero De aut probo fuisset politus.', 6, 'accepted', '2023-07-18 16:57:03', '2023-07-18 16:57:03'),
('17', 'Feminea in in autem quae truculenti eum mariti autem abrupte.', 3, 'pending', '2023-07-19 10:44:01', '2023-07-19 10:44:01'),
('18', 'Patriae ne patriae sit ne potius curae concessum futurum coepit.', 4, 'pending', '2023-07-19 12:08:35', '2023-07-19 12:08:35'),
('19', 'Tuniculam nihil usque nomine sermone Tyrii textam denique textrini usque.', 5, 'pending', '2023-07-20 12:11:00', '2023-07-20 12:11:00'),
('20', 'Fuisset probo deterruisset instructior cetero De aut probo fuisset politus.', 6, 'pending', '2023-07-10 16:57:03', '2023-07-10 16:57:03');

INSERT INTO tags (id, name, badge)
VALUES 
('1', 'HTML', 'primary'),
('2', 'CSS', 'success'),
('3', 'JavaScript', 'warning'),
('4', 'Angular', 'danger'),
('5', 'PHP', 'info'),
('6', 'Python', 'dark');

INSERT INTO comment_post (id, comment_id, post_id)
VALUES 
('1', 1, 1),
('2', 2, 2),
('3', 3, 3),
('4', 4, 4),
('5', 5, 5),
('6', 6, 6),
('7', 7, 7),
('8', 8, 8),
('9', 9, 1),
('10', 10, 2),
('11', 11, 3),
('12', 12, 5),
('13', 13, 6),
('14', 14, 7),
('15', 15, 8),
('16', 16, 4),
('17', 17, 1),
('18', 18, 2),
('19', 19, 3),
('20', 20, 4);

INSERT INTO post_tag (id, post_id, tag_id)
VALUES 
('1', 1, 1),
('2', 1, 2),
('3', 2, 3),
('4', 2, 1),
('5', 2, 2),
('6', 3, 5),
('7', 3, 4),
('8', 3, 6),
('9', 4, 6),
('10', 4, 5),
('11', 5, 3),
('12', 5, 6),
('13', 6, 2),
('14', 7, 2),
('15', 7, 3),
('16', 8, 4),
('17', 8, 5);