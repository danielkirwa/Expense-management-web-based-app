else if(player == "player3" && playerview == "teamaplayer3view"){
    if(player3fouls == 5){
        Toast.makeText(this,"The player 3 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer3view.setVisibility(View.GONE);
    }else{
        player3fouls = player3fouls+ 1;
        showplayer3fouls.setText(player3fouls+"");
    }
}else if(player == "player4" && playerview == "teamaplayer4view"){
    if(player4fouls == 5){
        Toast.makeText(this,"The player 3 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer4view.setVisibility(View.GONE);
    }else{
        player4fouls = player4fouls+ 1;
        showplayer4fouls.setText(player4fouls+"");
    }
}else if(player == "player5" && playerview == "teamaplayer5view"){
    if(player5fouls == 5){
        Toast.makeText(this,"The player 5 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer5view.setVisibility(View.GONE);
    }else{
        player5fouls = player5fouls+ 1;
        showplayer5fouls.setText(player5fouls+"");
    }
}else if(player == "player6" && playerview == "teamaplayer6view"){
    if(player6fouls == 5){
        Toast.makeText(this,"The player 6 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer6view.setVisibility(View.GONE);
    }else{
        player6fouls = player6fouls+ 1;
        showplayer6fouls.setText(player6fouls+"");
    }
}else if(player == "player7" && playerview == "teamaplayer7view"){
    if(player7fouls == 5){
        Toast.makeText(this,"The player 7 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer7view.setVisibility(View.GONE);
    }else{
        player7fouls = player7fouls+ 1;
        showplayer7fouls.setText(player7fouls+"");
    }
}else if(player == "player8" && playerview == "teamaplayer8view"){
    if(player8fouls == 5){
        Toast.makeText(this,"The player 8 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer8view.setVisibility(View.GONE);
    }else{
        player8fouls = player8fouls+ 1;
        showplayer8fouls.setText(player8fouls+"");
    }
}else if(player == "player9" && playerview == "teamaplayer9view"){
    if(player9fouls == 5){
        Toast.makeText(this,"The player 9 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer9view.setVisibility(View.GONE);
    }else{
        player9fouls = player9fouls+ 1;
        showplayer9fouls.setText(player9fouls+"");
    }
}else if(player == "player10" && playerview == "teamaplayer10view"){
    if(player10fouls == 5){
        Toast.makeText(this,"The player 10 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer10view.setVisibility(View.GONE);
    }else{
        player10fouls = player10fouls+ 1;
        showplayer10fouls.setText(player10fouls+"");
    }
}else if(player == "player11" && playerview == "teamaplayer11view"){
    if(player11fouls == 5){
        Toast.makeText(this,"The player 11 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer11view.setVisibility(View.GONE);
    }else{
        player11fouls = player11fouls+ 1;
        showplayer11fouls.setText(player11fouls+"");
    }
}




int player1bfouls=0,player2bfouls=0,player3bfouls=0,player4bfouls=0,player5bfouls=0,player6bfouls=0,
        player7bfouls=0,player8bfouls=0,player9bfouls=0,player10bfouls=0,player11bfouls=0,player12bfouls=0;


        TextView showplayer1bfouls,showplayer2bfouls,showplayer3bfouls,showplayer4bfouls,
        showplayer5bfouls,showplayer6bfouls,showplayer7bfouls,showplayer8bfouls,showplayer9bfouls,
        showplayer10bfouls,showplayer11bfouls,showplayer12bfouls;


LinearLayout hideplayer1bview,hideplayer2bview,hideplayer3bview,hideplayer4bview,hideplayer5bview,hideplayer6bview,
        hideplayer7bview,hideplayer8bview,hideplayer9bview,hideplayer10bview,hideplayer11bview,hideplayer12bview;


        showplayer1bfouls = findViewById(R.id.player1bfouls);
        hideplayer1bview = findViewById(R.id.player1bview);
        showplayer2bfouls = findViewById(R.id.player2bfouls);
        hideplayer2bview = findViewById(R.id.player2bview);
        showplayer3bfouls = findViewById(R.id.player3bfouls);
        hideplayer3bview = findViewById(R.id.player3bview);
        showplayer4bfouls = findViewById(R.id.player4bfouls);
        hideplayer4bview = findViewById(R.id.player4bview);
        showplayer5bfouls = findViewById(R.id.player5bfouls);
        hideplayer5bview = findViewById(R.id.player5bview);
        showplayer6bfouls = findViewById(R.id.player6bfouls);
        hideplayer6bview = findViewById(R.id.player6bview);
        showplayer7bfouls = findViewById(R.id.player7bfouls);
        hideplayer7bview = findViewById(R.id.player7bview);
        showplayer8bfouls = findViewById(R.id.player8bfouls);
        hideplayer8bview = findViewById(R.id.player8bview);
        showplayer9bfouls = findViewById(R.id.player9bfouls);
        hideplayer9bview = findViewById(R.id.player9bview);
        showplayer10bfouls = findViewById(R.id.player10bfouls);
        hideplayer10bview = findViewById(R.id.player10bview);
        showplayer11bfouls = findViewById(R.id.player11bfouls);
        hideplayer11bview = findViewById(R.id.player11bview);
        showplayer12bfouls = findViewById(R.id.player12bfouls);
        hideplayer12bview = findViewById(R.id.player12bview);


           public void Player1b(View v){
        addfouls("player1b","teamaplayer1bview");
    }
    public void Player2b(View v){
        addfouls("player2b","teamaplayer2bview");
    }
    public void Player3b(View v){
        addfouls("player3b","teamaplayer3bview");
    }
    public void Player4b(View v){
        addfouls("player4b","teamaplayer4bview");
    }
    public void Player5b(View v){
        addfouls("player5b","teamaplayer5bview");
    }
    public void Player6b(View v){
        addfouls("player6b","teamaplayer6bview");
    }
    public void Player7b(View v){
        addfouls("player7b","teamaplayer7bview");
    }
    public void Player8b(View v){
        addfouls("player8b","teamaplayer8bview");
    }
    public void Player9b(View v){
        addfouls("player9b","teamaplayer9bview");
    }
    public void Player10b(View v){
        addfouls("player10b","teamaplayer10bview");
    }
    public void Player11b(View v){
        addfouls("player11b","teamaplayer11bview");
    }
    public void Player12b(View v){
        addfouls("player12b","teamaplayer12bview");
    }





    if( player == "player1b" && playerview == "teamaplayer1bview"){
    if(player1bfouls == 5){
        Toast.makeText(this,"The player 1 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer1bview.setVisibility(View.GONE);
    }else{
        player1bfouls = player1bfouls+ 1;
        showplayer1bfouls.setText(player1bfouls+"");
    }
}else if(player == "player2b" && playerview == "teamaplayer2bview"){
    if(player2bfouls == 5){
        Toast.makeText(this,"The player 2 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer2bview.setVisibility(View.GONE);
    }else{
        player2bfouls = player2bfouls+ 1;
        showplayer2bfouls.setText(player2bfouls+"");
    }
}
else if(player == "player3b" && playerview == "teamaplayer3bview"){
    if(player3bfouls == 5){
        Toast.makeText(this,"The player 3 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer3bview.setVisibility(View.GONE);
    }else{
        player3bfouls = player3bfouls+ 1;
        showplayer3bfouls.setText(player3bfouls+"");
    }
}else if(player == "player4b" && playerview == "teamaplayer4bview"){
    if(player4bfouls == 5){
        Toast.makeText(this,"The player 3 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer4bview.setVisibility(View.GONE);
    }else{
        player4bfouls = player4bfouls+ 1;
        showplayer4bfouls.setText(player4bfouls+"");
    }
}else if(player == "player5b" && playerview == "teamaplayer5bview"){
    if(player5bfouls == 5){
        Toast.makeText(this,"The player 5 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer5bview.setVisibility(View.GONE);
    }else{
        player5bfouls = player5bfouls+ 1;
        showplayer5bfouls.setText(player5bfouls+"");
    }
}else if(player == "player6b" && playerview == "teamaplayer6bview"){
    if(player6bfouls == 5){
        Toast.makeText(this,"The player 6 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer6bview.setVisibility(View.GONE);
    }else{
        player6bfouls = player6bfouls+ 1;
        showplayer6bfouls.setText(player6bfouls+"");
    }
}else if(player == "player7b" && playerview == "teamaplayer7bview"){
    if(player7bfouls == 5){
        Toast.makeText(this,"The player 7 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer7bview.setVisibility(View.GONE);
    }else{
        player7bfouls = player7bfouls+ 1;
        showplayer7bfouls.setText(player7bfouls+"");
    }
}else if(player == "player8b" && playerview == "teamaplayer8bview"){
    if(player8bfouls == 5){
        Toast.makeText(this,"The player 8 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer8bview.setVisibility(View.GONE);
    }else{
        player8bfouls = player8bfouls+ 1;
        showplayer8bfouls.setText(player8bfouls+"");
    }
}else if(player == "player9b" && playerview == "teamaplayer9bview"){
    if(player9bfouls == 5){
        Toast.makeText(this,"The player 9 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer9bview.setVisibility(View.GONE);
    }else{
        player9bfouls = player9bfouls+ 1;
        showplayer9bfouls.setText(player9bfouls+"");
    }
}else if(player == "player10b" && playerview == "teamaplayer10bview"){
    if(player10bfouls == 5){
        Toast.makeText(this,"The player 10 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer10bview.setVisibility(View.GONE);
    }else{
        player10bfouls = player10bfouls+ 1;
        showplayer10bfouls.setText(player10bfouls+"");
    }
}else if(player == "player11b" && playerview == "teamaplayer11bview"){
    if(player11bfouls == 5){
        Toast.makeText(this,"The player 11 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer11bview.setVisibility(View.GONE);
    }else{
        player11bfouls = player11bfouls+ 1;
        showplayer11bfouls.setText(player11bfouls+"");
    }
}else if(player == "player12b" && playerview == "teamaplayer12bview"){
    if(player12bfouls == 5){
        Toast.makeText(this,"The player 12 has maximum number of fouls",Toast.LENGTH_LONG).show();
        hideplayer12bview.setVisibility(View.GONE);
    }else{
        player12bfouls = player12bfouls+ 1;
        showplayer12bfouls.setText(player12bfouls+"");
    }
}