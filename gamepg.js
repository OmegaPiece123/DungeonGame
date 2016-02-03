//Each spirte's limits and placements
function Sprite(x, y, w, h, minX, minY, maxX, maxY)//Credits by Mr. Turner.
{
	this.xCoord = x;
    this.yCoord = y;
    this.width = w;
    this.height = h;
	     
    this.minXCoord = minX;
    this.minYCoord = minY;
    this.maxXCoord = maxX;
    this.maxYCoord = maxY;
	
	this.getRight = function()      {return this.xCoord + this.width;}
    this.getBottom = function()     {return this.yCoord + this.height;}
	
	this.move = function(dx, dy)
    {
        if (this.xCoord + dx > this.minXCoord && 
            this.getRight() + dx < this.maxXCoord && 
            this.yCoord + dy > this.minYCoord && 
            this.getBottom() + dy < this.maxYCoord)
        {
            this.xCoord += dx;
            this.yCoord += dy;
			display();
        }
    }
	
    this.hasCollision = function(otherSprite)
    {
        if (this.getRight() < otherSprite.xCoord ||
            this.xCoord > otherSprite.getRight() ||
            this.getBottom() < otherSprite.yCoord ||
            this.yCoord > otherSprite.getBottom())
        {
            return false;
        }
 
        return true;
    }
	
	this.locateSprites = function() //finding sprite location
	{
		this.xbullet = this.xCoord + (this.width/3.5);
		this.ybullet = this.yCoord -  (this.height/4);
	}
}
function Character(health, attack, speed, defense)
{
	this.HP = health;
	this.ATTACK = attack;
	this.SPEED = speed;
	this.DEFENSE = defense;
	this.hasDefeated = function()
	{
		if(this.HP <= 0)
		{
			return true;
		}
		return false;
	}
}
function display()
{
	for (var i = 0; i < spriteImg.length; i++)
	{
		t = spriteImg[i].sprite;
		spriteImg[i].style.left = t.xCoord + "px";
		spriteImg[i].style.top = t.yCoord + "px";
	}
	playerH.innerHTML = "Player HP: " +  playerC.HP;
	playerH.style.top = totalHeight*0.02 + "px";
	monsterH.innerHTML = "Monster HP: " + monsterC.HP ;
}