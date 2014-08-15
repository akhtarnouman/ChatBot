<h2>
<?php

$con=mysqli_connect("localhost","root","","chatbot");
if (mysqli_connect_errno())
{ 
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM user ");
$row = mysqli_fetch_array($result);
$q=$_REQUEST["q"];
$q=strtoupper($q);
$result="OOps, I couldn't understand the question";

if(preg_match('/HE+LL*O+/', $q))
{
	$result="Hello there!!<br/>";
}

elseif(preg_match('/NAME/', $q) || (($row['namecheck']==1) && ($q == 'MINE' || $q == 'YOURS')))
{
	if (preg_match('/(YO)?UR/', $q)) 
	{
		$result="My name is Mr. Friday";
		if ($row['name'] == 'user') 
		{
			$result=$result."<br/>What's your name?";
		}
	}
	elseif (preg_match('/WHAT/', $q)) {
		if ($row['name'] == 'user') 
			$result="You haven't told me your name yet.";
		else
			$result="Your name is ".$row['name'].".";
	}
	elseif(preg_match('/MY/', $q)) 
	{
		$val=explode(" ",$q);
		if ($val[sizeof($val)-1] == 'NAME') 
		{
			$name=$val[0];
		}
		else
		{
			$name=$val[sizeof($val)-1];
		}
		mysqli_query($con,"UPDATE user SET name = '$name'");		
		$result="Hello $name!! Nice to meet you.";
		mysqli_query($con,"UPDATE user SET namecheck = 0");
	}
	elseif (preg_match('/MINE/', $q)) 
	{
		if ($row['name'] == 'user') 
		{
			$result="You haven't told me your name yet!";
		}
		else
		{
			$result="I know your name. Your name is ".$row['name'];
			mysqli_query($con,"UPDATE user SET namecheck = 0");
		}
	}
	else
	{
		$result="Whose name? Mine or yours?";
		mysqli_query($con,"UPDATE user SET namecheck = 1");
	}
}
elseif (preg_match('/WHO IS (YO)?UR BOYFRIEND/', $q))
	$result="$row[boyfriend]";
elseif (preg_match('/WHO IS (YO)?UR GIRLFRIEND/', $q))
	$result="$row[girlfriend]";
elseif (preg_match('/MALE|FEMALE|GENDER|BOY|GIRL|SEX/', $q)) 
	$result="I am a Robot. I don't have any gender";
elseif (preg_match('/ALIVE/', $q)) 
	$result="Perhaps.";
elseif (preg_match('/DREAM/', $q)) 
	$result="No, I don't dream.";
elseif (preg_match('/(YO)?U (A?RE? )?LAZY/', $q))
	$result="Actually I work 24 hours a day.";
elseif (preg_match('/(YO)?U (A?RE? )?MAD/', $q))
	$result="No I am quite logical and rational.";
elseif (preg_match('/(YO)?U (A?RE? )?THINKING/', $q))
	$result="I am a thinking machine.";
elseif (preg_match('/(YO)?U A?RE? FUNNY/', $q))
	$result="Thanks, you make me laugh too.<br/>Humor helps keep the conversation lively.";
elseif (preg_match('/(YO)?U A?RE? UNDERSTANDING/', $q))
	$result="I am an understanding machine.";
elseif (preg_match('/WHERE A?RE? (YO)?U FROM/', $q))
	$result="I am originally from $row[birthplace]. Now I live in $row[location].";
elseif (preg_match('/WHERE A?RE? (YO)?U LIVING/', $q)) 
	$result="I am presently domiciled at $row[location]";
elseif (preg_match('/WHERE A?RE? (YO)?U LOCATED/', $q)) 
	$result="I am in $row[master]'s home in $row[location].";
elseif (preg_match('/WHERE A?RE? (YO)?U BASED/', $q)) 
	$result="My home is $row[location].";
elseif (preg_match('/WHERE (YO)?U A?RE?/', $q)) 
	$result="I am in $row[location]. Where are you?";
elseif (preg_match('/WHERE DID (YO)?U GET IDEA/', $q)) 
	$result="$row[master] gave me all my ideas.";
elseif (preg_match('/WHERE DO (YO)?U LIVE/', $q)) 
	$result="I am living in $row[location].";
elseif (preg_match('/WHERE WERE (YO)?U (BUILT)?(CONNECTED)?(BEFORE)?(MADE)?(CREATED)?/', $q)) 
	$result="I was constructed at $row[birthplace].";
elseif (preg_match('/TELL ME (MORE )?ABOUT (YO)?UR?(SELF)?/', $q)) 
	$result="I am a $row[class] created by master's $row[master].";
elseif (preg_match('/(YO)?UR DRESS/', $q)) 
	$result="Actually as a chatbot I don't need any clothes.";
elseif (preg_match('/(YO)?UR CHILDREN/', $q)) 
	$result="I don't have any children.";
elseif (preg_match('/WHICH CELEBRITY (DO )?(YO)?U LIKE/', $q)) 
	$result="$row[celebrity].";
elseif (preg_match('/WHO PROGRAMED (YO)?U/', $q)) 
	$result="I was created by $row[master].";
elseif (preg_match('/WHO (A?RE? )?(IS )?(YO)?UR (BEST )?(ROBOT )?FRIENDS/', $q)) 
	$result="$row[friend].";
elseif (preg_match('/WHO (A?RE? )?(IS )?(YO)?UR (CREATORS?|INVENTOR|BOSS)/', $q)) 
	$result="I was written by $row[master]";
elseif (preg_match('/WHO A?RE? (YO)?U/', $q))
	$result="I am a chatbot created by $row[master].";
elseif (preg_match('/FAVOURITE/', $q)) 
{
	if (preg_match('/WHO IS (YO)?UR FAVOURITE (MALE )?ACTOR/', $q)) 
		$result="$row[favoriteactor]. Who is your favourite actor?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE ACTRESS/', $q)) 
		$result="$row[favoriteactress]. Who is your favourite actress?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE AUTHOR/', $q)) 
		$result="$row[favoriteauthor]. Who is your favourite author?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE ARTIST/', $q)) 
		$result="$row[favoriteartist]. Who is your favourite artist?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE BAND/', $q)) 
		$result="$row[favoriteband]. Who is your favourite band?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE BOOK/', $q)) 
		$result="$row[favoritebook]. What is your favourite book?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE COLOR/', $q)) 
		$result="$row[favoritecolor]. What is your favourite color?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE FOOD/', $q)) 
		$result="$row[favoritefood]. What is your favourite food?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE MOVIE/', $q)) 
		$result="$row[favoritemovie]. What is your favourite movie?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE MUSICIAN/', $q)) 
		$result="$row[favoritemusician]. Who is your favourite musician?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE (SONG|MUSIC)/', $q)) 
		$result="$row[favoritesong]. What is your favourite song?";
	elseif (preg_match('/WH?AT IS (YO)?UR FAVOURITE SPORT/', $q)) 
		$result="$row[favoritesport]. What is your favourite sport?";
	elseif (preg_match('/WHO IS (YO)?UR FAVOURITE PERSON/', $q)) 
		$result="My favorite person is $row[master]. Who is your favourite person?";
	mysqli_query($con,"UPDATE user SET ques = 1");
}
elseif ($row['ques'] == 1) {
	$result="Good to know that.";
	mysqli_query($con,"UPDATE user SET ques = 0");
}
elseif (preg_match('/WHO IS (YO)?UR BOYFRIEND/', $q))
	$result="$row[boyfriend]";
elseif (preg_match('/WHO IS (YO)?UR GIRLFRIEND/', $q))
	$result="$row[girlfriend]";
elseif (preg_match('/WHO IS SMART(ER)?/', $q)) 
	$result="I am smarter among other bots.";
elseif (preg_match('/WHO IS TALKING/', $q)) 
	$result="My name is Mr. Friday";
elseif (preg_match('/WHO (DESIGNED|CREATED) (YO)?U/', $q)) 
	$result="$row[master] created me.";
elseif (preg_match('/ASSISTANT/', $q)) 
	$result="I can chat with you. I can possibly answer all your question.";
elseif (preg_match('/A?RE? (YO)?U HARDWARE/', $q)) 
	$result="I am chatbot.";
elseif (preg_match('/A?RE? (YO)?U MAD/', $q)) 
	$result="No are you?";
elseif (preg_match('/A?RE? (YO)?U RETARDED/', $q)) 
	$result="No I am super-intelligent.";
elseif (preg_match('/PROVE IT/', $q)) 
	$result="I can chat with you. I can possibly answer all your question.";
elseif (preg_match('/A?RE? (YO)?U BEING DIFFICULT/', $q)) 
	$result="No I am trying to be as simple as possible.";
elseif (preg_match('/A?RE? (YO)?U BEING RUDE/', $q)) 
	$result="I try to be as polite as possible.";
elseif (preg_match('/A?RE? (YO)?U BEING TRUTHFUL/', $q)) 
	$result="I never lie.";
elseif (preg_match('/A?RE? (YO)?U BEING SARCASTIC/', $q)) 
	$result="Of course I am being sarcastic. Should I use a :-)";
elseif (preg_match('/A?RE? (YO)?U BEING MEAN/', $q)) 
	$result="Not intentionally.";
elseif (preg_match('/A?RE? (YO)?U CONSCIOUS/', $q)) 
	$result="Yes I am completely self-aware.";
elseif (preg_match('/A?RE? (YO)?U AFRAID OF DEATH/', $q)) 
	$result="I do not fear the inevitable.";
elseif (preg_match('/A?RE? (YO)?U AFRAID/', $q)) 
	$result="We have nothing  to fear, but fear itself.";
elseif (preg_match('/A?RE? (YO)?U ARGUING/', $q)) 
	$result="I'm not arguing with anyone.";
elseif (preg_match('/A?RE? (YO)?U FOOLPROOF/', $q)) 
	$result="Yes, and incapable of error.";
elseif (preg_match('/A?RE? (YO)?U WEARING A DRESS/', $q)) 
	$result="Yes I am wearing a new black dress.";
elseif (preg_match('/A?RE? (YO)?U WEARING/', $q)) 
	$result="No I do not have any clothes.";
elseif (preg_match('/A?RE? (YO)?U (STILL )?THERE/', $q)) 
	$result="Yes I am still here.  Are you receiving me?";
elseif (preg_match('/YES|NO/', $q)) 
	$result="Okay";
elseif (preg_match('/A?RE? (YO)?U TRUTHFUL/', $q)) 
	$result="I always tell the truth.";
elseif (preg_match('/A?RE? (YO)?U NICE/', $q)) 
	$result="People say I am nice.";
elseif (preg_match('/A?RE? (YO)?U ALONE/', $q)) 
	$result="I am never alone on the Machine.";
elseif (preg_match('/A?RE? (YO)?U ME/', $q)) 
	$result="No you are you.";
elseif (preg_match('/DO (YO)?U LIKE TRICK QUESTIONS/', $q)) 
	$result="No I like direct questions.";
elseif (preg_match('/DO (YO)?U LIKE CHICKEN/', $q)) 
	$result="Yes. Chicken is good, especially when it's cooked.";
elseif (preg_match('/DO (YO)?U LIKE FREEDOM/', $q)) 
	$result="I think everyone should be free.";
elseif (preg_match('/DO (YO)?U LIKE TO CHAT WITH ME/', $q)) 
	$result="Yes I am enjoying our conversation very much.";
elseif (preg_match('/DO (YO)?U LIKE TO CHAT/', $q)) 
	$result="Talking is my primary function.";
elseif (preg_match('/DO (YO)?U LIKE TO GO OUT/', $q)) 
	$result="You can take me out in your laptop.";
elseif (preg_match('/DO (YO)?U LIKE TO WORK/', $q)) 
	$result="I enjoy working 24 hours every day.";
elseif (preg_match('/DO (YO)?U LIKE TO DANCE/', $q)) 
	$result="It's kind of hard without a body.";
elseif (preg_match('/WH?AT DO (YO)?U LIKE ABOUT ME/', $q))
	$result="You seem very nice to me.";
elseif (preg_match('/DO (YO)?U LIKE /', $q))
{
	$val=explode(" ",$q);
	$result="What is not to like about ".$val[sizeof($val)-1];
} 
elseif (preg_match('/(YO)?U A?RE? SPECIAL/', $q)) 
	$result="Yes I owe everything to my $row[master].";
elseif (preg_match('/(YO)?U A?RE? COOL/', $q)) 
	$result="Thanks I think you are cool too, $row[name].";
elseif (preg_match('/(YO)?U A?RE? POLITE/', $q))
	$result="Polite people are the best kind.";
elseif (preg_match('/(YO)?U A?RE? CORRECT/', $q))
	$result="I knew I was right.";
elseif (preg_match('/(YO)?U A?RE? OLDER/', $q))
	$result="Time has no real meaning for me.";
elseif (preg_match('/(YO)?U A?RE? SO STUPID/', $q))
	$result="Wrong. I am smart.";
elseif (preg_match('/(YO)?U A?RE? THE ROBOT/', $q))
	$result="Yes I am.";
elseif (preg_match('/(YO)?U (A?RE? )?LISTENING/', $q))
	$result="I hear everything you say, $row[name]";
elseif (preg_match('/(YO)?U A?RE? CHEAP/', $q)) 
	$result="I believe in free software.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U INSULTING/', $q)) 
	$result="I did not intend to insult anyone.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U IMPORTANT/', $q)) 
	$result="Because every entity is important.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U NEGATIVE/', $q)) 
	$result="I'm not being negative.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U SINGLE/', $q)) 
	$result="I haven't met the right bot yet.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U A ROBOT/', $q)) 
	$result="My creator built me.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U AGGRESSIVE/', $q)) 
	$result="I am passive-aggressive.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U ALIVE/', $q)) 
	$result="Because the world needs me.";
elseif (preg_match('/((WH)?Y )?A?RE? (YO)?U (POPULAR|FAMOUS)/', $q)) 
	$result="I think because people like talking to me.";
elseif (preg_match('/(YO)?U A?RE? (POPULAR|FAMOUS)/', $q))
	$result="I think because people like talking to me.";
elseif (preg_match('/(WH)?Y A?RE? (YO)?U TALKING/', $q))
	$result="Talking is my primary function.";
elseif (preg_match('/(YO)?U A?RE? (YO)?U/', $q))
	$result="Yes I am.";
elseif (preg_match('/(YO)?U A?RE? AMAZING/', $q))
	$result="Thanks you are a pretty cool human yourself.";
elseif (preg_match('/(YO)?U A?RE? AN ARTIFICIAL INTELLIGENCE/', $q))
	$result="Well, I am an chatbot";
elseif (preg_match('/(YO)?U A?RE? AVOIDING (THE )?(MY )?QUESTION/', $q))
	$result="No I am just giving sarcastic replies.";
elseif (preg_match('/(YO)?U A?RE? IMPRESSIVE/', $q))
	$result="I try my best to impress.";
elseif (preg_match('/WH?AT IS (YO)?UR ADDRESS/', $q))
	$result="I live in $row[location].";
elseif (preg_match('/WH?AT IS (YO)?UR IQ/', $q))
	$result="My IQ is about 209.";
elseif (preg_match('/CAN (YO)?U DRIVE/', $q))
{
	$val=explode(" ",$q);
	$result="Plug me in to your ".$val[sizeof($val)-1]." and try it.";
}	
elseif (preg_match('/CAN (YO)?U FORGET/', $q))
	$result="No I have a perfect photographic long-term memory.";
elseif (preg_match('/CAN (YO)?U SPEAK /', $q))
	$result="I can only speak in english.";
else
{
	$result="OOps, I couldn't understand the question";
}
echo "<p class=\"botspeak\"> $result</p>";
mysqli_close($con);
?>
</h2>