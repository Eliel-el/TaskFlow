# METHODES DE TESTS ET VALIDATION LOGICIELLE
## Les bases de tests

Pour tester de manière exhaustive et efficace le code ,
Il faut connaitre **tous le cas possibles** à tester à partir des exigences et specification fonctionnelle et son fonctonnelle.

### Les classes ou les partition d'équivalence

Une classe/partion d'équivalence c'est l'ensemble de valeur d'entrées qui donne la même valeur de sortie.

Par exemple pour la fonction estMajeur(), il y a 3 classes d'équivalences qui sont : 
1. Classe âge majeur, **[18, + infin] => true**
2. Classe âge mineur, **[0, 18[ => false**
3. Classe âge invalide, **[- infini, O[ => Exception**
NB : chaque cas d'une classe d'équivance est un cas de BASE

### Le cas limites  

Les cas limites sont des cas qui se trouvent entre deux classes d'équivalence consécutives. Voici les cas limites pour la fonction `estMajeur()` :

1. Entre la classe "âge majeur" et "âge mineur" : **18 ans**.
2. Entre la classe "âge mineur" et "âge invalide" : **0 ans**.

### Les cas d'exctions


