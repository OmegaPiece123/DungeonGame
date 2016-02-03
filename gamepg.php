<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			Game Page
		</title>
		<?php
			$uname = $_POST['uname'];
			$conn = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1713632_project','a1713632_project','ihateoracle123');
			$cmd = "SELECT nname FROM alldata WHERE uname='$uname'";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		   	$data = $statement->fetch();
			
		?>
		<link rel= "stylesheet" href= "stylepage.css">
		<script src = "gamepg.js"></script>
		<script>
			var GOLD = 0, STAGE = 1, HP = 100, SPEED = 10, DEFENSE = 0, ATTACK = 5, BOSSHP = 100, BOSSATTACK = 2, BOSSSPEED = 10, BOSSDEFENSE = 0, SCORE = 0;
			var totalWidth = screen.width;
			var totalHeight = screen.height;
			var pxPos = totalWidth*.5,pyPos = totalHeight*.7;
			var mxPos = pxPos - totalWidth*.05, myPos = totalHeight*.095;
			var xlimR = totalWidth * 0.9;
			var xlimL = totalWidth * 0.1;
			var ylimU = totalHeight * 0.093;
			var ylimD = totalHeight * 0.8;
			var UP = 87, LEFT = 65, DOWN = 83, RIGHT = 68, ATT = 32;
			var sprites = new Array();
			var spriteImg = new Array();
			var spaceKey = true;
			var numBox = 0;
			var dmgArray = new Array();
			var bullet, player, monster;
			var timer = false;
			var times = 0;
			
			
			function update()
			{
				story = document.getElementById("storyline");
				shop = document.getElementById("shop");
				pStage = document.getElementById("stage");
				pGold = document.getElementById("gold");
				pHp = document.getElementById("hp");
				pMana = document.getElementById("mana");
				pSpeed = document.getElementById("speed");
				pDefense = document.getElementById("defense");
				pAttack = document.getElementById("attack");
				mHp = document.getElementById("monsterhealth");
				mSpeed = document.getElementById("monsterspeed");
				mDefense = document.getElementById("monsterdefense");
				mAttack = document.getElementById("monsterattack");
				
				theStatus = document.getElementById("status");
				theScore = document.getElementById("score");
				
				
				winScreen = document.getElementById("winningScreen");
				
				playerH = document.getElementById("playerHP");
				monsterH =  document.getElementById("monsterHP");
				
				pStage.innerHTML = "Stage: " + STAGE;
				pGold.innerHTML = "Gold: " + GOLD;
				pHp.innerHTML = "Hp: " + HP;
				pSpeed .innerHTML = "Speed: " + SPEED;
				pDefense.innerHTML  = "Defense: " + DEFENSE;
				pAttack.innerHTML = "Attack: " + ATTACK;
				
				mHp.innerHTML = "Monster Hp: " + BOSSHP;
				mSpeed .innerHTML = "Monster Speed: " + BOSSSPEED;
				mDefense.innerHTML  = "Monster Defense: " + BOSSDEFENSE;
				mAttack.innerHTML = "Monster Attack: " + BOSSATTACK;
				
				theScore.innerHTML = "Score: " + SCORE;
				
				winScreen.style.display = "none";
				gScreen = document.getElementById("gameScreen");
				theImages = gScreen.getElementsByTagName("img");
			}
			
			function movePlayer(e)
			{
				if (e.which)
				{
					key = e.which;
				}
				else
				{
					key = e.keyCode;
				}	
				var dx = 0;
				var dy = 0;				
				
				if (key == LEFT)
				{
					dx = -SPEED;
				}

				if (key == UP)
				{
					dy = -SPEED;
				}

				if (key == RIGHT)
				{
					dx = SPEED;
				}

				if (key == DOWN)
				{
					dy = SPEED;
				}	
				player.move(dx, dy);
				checkMove();
				
			}
			function checkMove()
			{
				for (var i = 0; i < sprites.length; i++)
				{
					if (player === sprites[i] || bullet === sprites[i])
					{
						continue;
					}
					
					if (player.hasCollision(sprites[i]))
					{
						var dmg =  monsterC.ATTACK - playerC.DEFENSE;
						if(dmg < 0)
						{
							playerC.HP -= 2;
						}
						else
						{
							playerC.HP -= dmg;
						}
						if(playerC.hasDefeated())
						{
							SCORE -= 10;
							theStatus.style.display = "block";
							theStatus.innerHTML = "You have Died";
							endAll();
						}
						break;
					}
				}
			}
			function moveBullet(e)
			{
				if (e.which)
				{
					key = e.which;
				}
				else
				{
					key = e.keyCode;
				}
				
				if(key == ATT && spaceKey)
				{
					spaceKey = false;
					player.locateSprites();
					playerH.style.left = player.xbullet;
					playerH.style.top = player.ybullet;
					bullet = new Sprite(player.xbullet, player.ybullet, 11, 9, xlimL, ylimU, xlimR, ylimD);
					sprites.push(bullet);
					placeSprite(bullet, "sprite/bullet.png");
					makeMove = setInterval(function(){checkBullet()}, 50);
					timer = true;
				}
			}
			function moveMonster()
			{
				monster.locateSprites();
				if(monster.xCoord + dx >= xlimR - monster.width - totalWidth*0.005)
				{
					dx = -BOSSSPEED;
				}
				if(monster.xCoord + dx <= xlimL + 0.1*xlimL)
				{
					dx = BOSSSPEED;
				}
				monster.move(dx, dy);
			}
			function checkBullet()
			{
				var dx = 0;
				var dy = -10;
				bullet.move(dx, dy);
				outer:for (var i = 0; i < sprites.length; i++) 
				{
					if(bullet.hasCollision(sprites[i]) && sprites[i] === monster)
					{
						var dmg = playerC.ATTACK - monsterC.DEFENSE
						if(dmg < 0)
						{
							monsterC.HP -= 5
						}
						else
						{
							monsterC.HP -= dmg;
						}
						if(monsterC.hasDefeated())
						{
							if(STAGE >= 15)
							{
								endAll();
								SCORE += 1000;
								shop.style.display = "none";
								pStage.style.display = "none";
								pGold.style.display = "none";
								pHp.style.display = "none";
								pSpeed.style.display = "none";
								pDefense.style.display = "none";
								pAttack.style.display = "none";
								winScreen.style.display = "block";
								winScreen.innerHTML = "YOU HAVE WON!!!!!!!!!!" + "<br />" + "Your final score is: " + SCORE + "<br />"
								+ "<?php echo("<form action = 'store.php' method = 'post'> <input name = 'uname' type = 'hidden' value = '$uname' /> <input id = 'input' name = 'score' type = 'hidden' /> <input value = 'Store the score' type = 'submit' /> </form>"); ?>";
								theInput = document.getElementById("input");
								theInput.setAttribute("value", SCORE);
								break;
							}
							
							STAGE++;
							SCORE += 1000;
							BOSSHP += 50;
							BOSSATTACK++;
							BOSSSPEED += 1.5;
							BOSSDEFENSE++;
							theStatus.style.display = "block";
							theStatus.innerHTML = "You are in stage " + STAGE;
							endAll();
							break;
						}
					}
					if ((bullet.hasCollision(sprites[i]) && sprites[i] === monster) || bullet.yCoord + dy <= bullet.minYCoord)
					{
						for(c = 0; c < spriteImg.length; c++)
						{
							if(bullet === sprites[c] && spriteImg[c].imgName == "sprite/bullet.png") //removal of the images
							{
								GOLD += (parseInt(Math.random() * 5) + STAGE);
								sprites.splice(c,1);
								gScreen.removeChild(spriteImg[c]);//if hits, disappear.
								spriteImg.splice(c,1);
								spaceKey = true;
								clearInterval(makeMove);
								timer = false;
								break outer;
							}
						}
					}		
				}
			}
			function placeSprite(t, imageFile)
			{
				
				tImg = document.createElement('img');
				tImg.src = imageFile;
				tImg.sprite = t;
				tImg.imgName = imageFile;
				gScreen.appendChild(tImg);
				spriteImg.push(tImg);
			}
			function endAll()
			{
				clearInterval(monsterMove);
				if(timer)
				{
					clearInterval(makeMove);
				}
				clearInterval(makeBox);
				clearInterval(checkings);
				gScreen.style.display = "none";
				sprites = new Array();
				spriteImg = new Array();
				spaceKey = true;
				numBox = 0;
				dmgArray = new Array();
				while (theImages.length > 0)
				{
					 theImages[0].parentNode.removeChild(theImages[0]);
				}
				bullet;
				timer = false;
				continueStory();
				display();
				update();
			}
			function continueStory()
			{
				story.style.display = "none";
				
				shop.style.display = "block";
				pStage.style.display = "block";
				pGold.style.display = "block";
				pHp.style.display = "block";
				pSpeed .style.display = "block";
				pDefense.style.display = "block";
				pAttack.style.display = "block";
				mHp.style.display = "block";
				mSpeed .style.display = "block";
				mDefense.style.display = "block";
				mAttack.style.display = "block";
				theScore.style.display = "block";
			}
			function continueShop()
			{
				shop.style.display = "none";
				pStage.style.display = "none";
				pGold.style.display = "none";
				pHp.style.display = "none";
				pSpeed.style.display = "none";
				pDefense.style.display = "none";
				pAttack.style.display = "none";
				gScreen.style.display = "block";
				playerH.style.display = "block";
				monsterH.style.display = "block";
				
				player = new Sprite(pxPos, pyPos, 41, 45, xlimL, ylimU, xlimR, ylimD);
				monster = new Sprite(mxPos, myPos, 124, 153, xlimL, ylimU, xlimR, ylimD);
			
				playerC = new Character(HP, ATTACK, SPEED, DEFENSE);
				monsterC = new Character(BOSSHP, BOSSATTACK, BOSSSPEED, BOSSDEFENSE);
				
				sprites.push(player);
				sprites.push(monster);
				
				
				placeSprite(player, "sprite/megaman.png");
				placeSprite(monster, "sprite/M1.PNG");
				
				if(times == 0)
				{
					document.body.setAttribute("onkeydown", "movePlayer(event);moveBullet(event);")
					times++;
				}
				
				
				dx = BOSSSPEED;
				dy = 0;
				monsterMove = setInterval(function(){moveMonster();}, 50);
				checkings = setInterval(function(){checkMove();},300);	
				makeBox = setInterval(function(){genNew(STAGE + 5);}, 1000);
				display();
			}
			function genNew(boxnum)
			{
				numBox++;
				if(numBox < boxnum)
				{
					var randomGenx = parseInt(Math.random()*(xlimR- xlimL)) + xlimL;
					var randomGeny = parseInt(Math.random()*(ylimD- ylimU)) + ylimU + 153;
					if (randomGeny >= ylimD)
					{
						randomGeny -= 430;
					}
					damage = new Sprite(randomGenx, randomGeny, 60, 60, xlimL, ylimU, xlimR, ylimD);
					dmgArray.push(damage);
					sprites.push(damage);
					placeSprite(damage, "sprite/damageBox.png");
				}
				else
				{
					for(i = 0; i < sprites.length; i++)
					{
						for(a = 0; a < dmgArray.length; a++)
						{
							if(dmgArray[a] === sprites[i] && spriteImg[i].imgName == "sprite/damageBox.png")
							{
								sprites.splice(i,1);
								gScreen.removeChild(spriteImg[i]);
								spriteImg.splice(i,1);
							}
						}						
					}
					numBox = 0;
				}
				
			}
			function buyItems(type, increase, cost, x)
			{
				if(GOLD > cost && type == "bows")
				{
					ATTACK += increase;
					GOLD -= cost;
					x.disabled = true;
					
					update();
				}
				if(GOLD > cost && type == "shields")
				{
					DEFENSE += increase;
					GOLD -= cost;
					x.disabled = true;
					
					update();
				}
				if(GOLD > cost && type == "boots")
				{
					SPEED += increase;
					GOLD -= cost;
					x.disabled = true;
					
					update();
				}
			}
		</script>
		
	</head>
	
	
	<body onload = "update();">
		<div id = "storyline" style = "font-size:40px;">
			Hello <?php echo($data[nname]);?>, Welcome to Dungeon Explorer. The objective is to clear 15 stages and achieve the highest score.
			You used wasd to move around and space to shoot. As you progress, the monster is going be stronger, at the same time, you can purchase items from
			the store to get stronger. Good luck.
		<br />
		<button onclick = "continueStory()">Continue</button>
		</div>
		<div id = "shop">
			<span id = "status"></span>
			<span id = "score"></span>
			<span id = "stage"></span>
			<span id = "gold"></span>
			<span id = "hp"></span>
			<span id = "speed"></span>
			<span id = "defense"></span>
			<span id = "attack"></span>
			<span id = "monsterhealth"></span>
			<span id = "monsterspeed"></span>
			<span id = "monsterdefense"></span>
			<span id = "monsterattack"></span>
			<br />
			<table border = "1"; style = "width:100%">
				<tr>
					<th>Bows </th>
					<th>Shields</th>
					<th>Boots  </th>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 3, 50, this)">Wooden Bow, $50, +3 ATT</button></td>
					<td><button onclick = "buyItems('shields', 3, 50, this )">Wooden Shield, $50, +3 DEF</button></td>
					<td><button onclick = "buyItems('boots', 3, 50, this)">Boot, $50, +3 SPD		 </button></td>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 6, 100, this)">Iron Bow, $100, +6 ATT	 </button></td>
					<td><button onclick = "buyItems('shields', 6, 100, this)">Iron Shield, $100, +6 DEF	 </button></td>
					<td><button onclick = "buyItems('boots', 6, 100,this)">Leather Boot, $100, +6 SPD </button></td>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 9, 200, this)">Gold Bow, $200, +9 ATT  </button></td>
					<td><button onclick = "buyItems('shields', 9, 200, this)">Gold Shield, $200, +9 DEF </button></td>
					<td><button onclick = "buyItems('boots', 9, 200, this)">Iron boot, $200, +9 SPD   </button></td>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 12, 300, this)">Platinum Bow, $300, +12 ATT </button></td>
					<td><button onclick = "buyItems('shields', 12, 300, this)">Platinum Shield, $300, +12 DEF</button></td>
					<td><button onclick = "buyItems('boots', 12, 300, this)">Adamant Boot, $300, +12 SPD   </button></td>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 15, 400, this)">Diamond Bow, $400, +15 ATT </button></td>
					<td><button onclick = "buyItems('shields', 15, 400, this)">Diamond Shield, $400, +15 DEF</button></td>
					<td><button onclick = "buyItems('boots', 15, 400, this)">Mystic Boot, $400, +15 SPD	  </button></td>
				</tr>
				<tr>
					<td><button onclick = "buyItems('bows', 20, 600, this)">Legendary Bow, $600, +20 ATT		 </button></td>
					<td><button onclick = "buyItems('shields', 20, 600, this)">Legendary Shield, $600, +20 DEF	 </button></td>
					<td><button onclick = "buyItems('boots', 20, 600, this)">Legendary Boot, $600, +20 SPD		 </button></td>
				</tr>
			</table>
			<br />
			<button onclick = "continueShop();" >Enter Cave</button>
		</div>
		<div id = "gameScreen"  >
			<div id = "playerHP">Player HP:</div>
			<div id = "monsterHP">Monster HP:</div>
		</div>
		<div id = "winningScreen">
			
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>