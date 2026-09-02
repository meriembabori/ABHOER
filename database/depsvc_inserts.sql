INSERT INTO `departement` (`idDepartement`,`nomDepartement`,`description`) VALUES
(1,'Secrétariat Général','Rattaché directement à la Direction.'),
(2,'Division Évaluation et Planification des Ressources en Eau','Évaluation et planification des ressources en eau.'),
(3,'Division Gestion Durable des Ressources en Eau','Gestion durable, développement et qualité des ressources en eau.'),
(4,'Division Domaine Public Hydraulique','Gestion, contrôle et affaires juridiques du Domaine Public Hydraulique (DPH).'),
(5,'Division Administrative et Financière','Gestion administrative, financière et des ressources humaines.'),
(6,'Délégation','Représentation provinciale de l\'agence.');

INSERT INTO `service` (`idService`,`idDepartement`,`nomService`,`capaciteAccueil`,`description`) VALUES
(1,1,'Service Informatique et Systèmes d\'Information',3,NULL),
(2,1,'Service de Communication et de Coopération',3,NULL),
(3,1,'Service Contrôle de Gestion et Audit Interne',3,NULL),
(4,2,'Service Suivi et Évaluation des Ressources en Eau',3,NULL),
(5,2,'Service Planification des Ressources en Eau et Études',3,NULL),
(6,3,'Service Gestion et Développement des Ressources en Eau',3,NULL),
(7,3,'Service Travaux et Aménagements Hydrauliques',3,NULL),
(8,3,'Service Qualité des Ressources en Eau',3,NULL),
(9,4,'Service Gestion du DPH',3,NULL),
(10,4,'Service des Affaires Juridiques et Contentieux',3,NULL),
(11,4,'Service Aides et Redevance',3,NULL),
(12,5,'Service Ressources Humaines et Moyens Généraux',3,NULL),
(13,5,'Service Finances et Programmation',3,NULL),
(14,5,'Service Comptabilité et Marchés',3,NULL),
(15,6,'Service Évaluation, Planification et Gestion de l\'Eau',3,NULL),
(16,6,'Service Gestion et Contrôle du DPH',3,NULL),
(17,6,'Service Administratif et Financier',3,NULL);
