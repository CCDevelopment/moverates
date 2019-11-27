

// Add commas function so we can see the distance returns more clearly
function addCommas(nStr){
   nStr += '';
   var x = nStr.split('.');
   var x1 = x[0];
   var x2 = x.length > 1 ? '.' + x[1] : '';
   var rgx = /(\d+)(\d{3})/;
   while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
   }
   return x1 + x2;
}

        printItems();

        //Create Item Objects, populate master item inventory list, display on front end
        function printItems (){

        // Single ITEM Object Constructor
            function hhgItem (name, volume, height, width, depth, image, icon, location, quantity, specialHandling, color) {
              this.name = name;
              this.volume = volume;
              this.height = height;
              this.width = width;
              this.depth = depth;
              this.image = image;
              this.icon = icon;
              this.location = location;
              this.quantity = quantity;
              this.specialHandling = specialHandling;
              this.color = color;
            }

          // Declare each of our individual Item objects
          // var tv = new hhgItem('tv', 25, 40, 50, 60, 'www.image.com', 'tv', ['Living Room', 'Bathroom', 'Dining Room'], 0, 'none', 'blue');
          // var bath = new hhgItem('bath', 35, 45, 55, 65, 'www.baths.com', 'bath', ['Living Room', 'Bedroom One'], 0, 'none', 'red');
          // var cube = new hhgItem('cube', 5, 6, 7, 8, 'www.cube.com', 'cube', ['Living Room', 'Bedroom Two', 'Dining Room'], 0, 'none', 'brown');
          // var paw = new hhgItem('paw', 5, 6, 7, 8, 'www.paw.com', 'paw', ['Living Room', 'Study', 'Bedroom One', 'Bedroom Two'], 0, 'none', 'white');
          // var phone = new hhgItem('phone', 5, 6, 7, 8, 'www.phone.com', 'phone', ['Living Room', 'Other Rooms'], 0, 'none', 'purple');
          // var pills = new hhgItem('pills', 5, 6, 7, 8, 'www.pills.com', 'pills',['Living Room', 'Dining Room'] , 0, 'none', 'grey');
          // var ambulance = new hhgItem('ambulance', 5, 6, 7, 8, 'www.ambulance.com', 'ambulance', ['Living Room', 'Master Bedroom'], 0, 'none', 'orange');
          // var archive = new hhgItem('archive', 5, 6, 7, 8, 'www.archive.com', 'archive', ['Living Room', 'kitchen', 'Other Rooms'], 0, 'none', 'yellow');

          var Artificialplant = new hhgItem('Plant',20 ,0 ,0 ,0 ,'www.image.com', 'flaticon-yard-tree-of-circular-shape-in-a-pot', ['Living Room' , 'Dining Room', 'Master Bedroom', 'Study'], 0 ,'none','none');
          var BabyCrib = new hhgItem('Baby Crib',8 ,0 ,0 ,0 ,'www.image.com', 'flaticon-baby-crib-bedroom-furniture', ['Bedroom One', 'Bedroom Two', 'Master Bedroom'], 0 ,'none','none');
          var BarbecueGrill = new hhgItem('Barbecue Grill',20 ,0 ,0 ,0 ,'www.image.com', 'flaticon-covered-barbecue', ['Other Rooms'], 0 ,'none','none');
          var Basket = new hhgItem('Basket',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-magazines-drawer-of-grid-design', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var BedDouble = new hhgItem('Double Bed',80 ,0 ,0 ,0 ,'www.image.com', 'flaticon-king-size-bedroom', ['Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Other Rooms'], 0 ,'none','none');
          var BedKing = new hhgItem('King Bed',100 ,0 ,0 ,0 ,'www.image.com', 'flaticon-queen-size-bed', ['Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Other Rooms'], 0 ,'none','none');
          var BedQueen = new hhgItem('Queen Bed',90 ,0 ,0 ,0 ,'www.image.com', 'flaticon-queen-size-bed', ['Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Other Rooms'], 0 ,'none','none');
          var BedSingle = new hhgItem('Single Bed',60 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bed-side-view', ['Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Other Rooms'], 0 ,'none','none');
          var BookcaseLarge = new hhgItem('Large Bookcase',25 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-objects-in-library', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var BookcaseMedium = new hhgItem('Medium Bookcase',15 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-objects-in-library', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var BookcaseSmall = new hhgItem('Small Bookcase',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-objects-in-library', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var CabinetLarge = new hhgItem('Large Cabinet',25 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-closet-with-opened-door-of-the-side-to-hang-clothes', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var CabinetMedium = new hhgItem('Medium Cabinet',20 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-black-closed-closet-for-clothes', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var CabinetSmall = new hhgItem('Small Cabinet',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-drawers-furniture', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var CartonDishpack = new hhgItem('Dishes Carton',7 ,0 ,0 ,0 ,'www.image.com', 'flaticon-kitchen-circular-ceramic-plates-stacked', ['Dining Room', 'kitchen'], 0 ,'none','none');
          var CartonDishpackPotsPans = new hhgItem('Pots and Pans Carton',7 ,0 ,0 ,0 ,'www.image.com', 'flaticon-frying-pan', ['Dining Room', 'kitchen'], 0 ,'none','none');
          var CartonFlatWardrobe = new hhgItem('Clothing Carton',4 ,0 ,0 ,0 ,'www.image.com', 'flaticon-clothes-hanging-on-rope-for-drying', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var CartonLarge = new hhgItem('Large Carton',5 ,0 ,0 ,0 ,'www.image.com', 'flaticon-black-box-for-storage-and-organization-of-things', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var CartonMedium = new hhgItem('Medium Carton',4 ,0 ,0 ,0 ,'www.image.com', 'flaticon-black-box-for-storage', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var CartonSmall = new hhgItem('Small Carton',2 ,0 ,0 ,0 ,'www.image.com', 'flaticon-black-box-for-storage', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var ChairArm = new hhgItem('Arm Chair',12 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-armchair', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var ChairOfficeStudy = new hhgItem('Office Chair',15 ,0 ,0 ,0 ,'www.image.com', 'flaticon-chair-with-wheels-of-studio-furniture', ['Living Room', 'Bedroom One', 'Bedroom Two', 'Study', 'Other Rooms'], 0 ,'none','none');
          var ChairStraight = new hhgItem('Straight Chair',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-dining-room-chair', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var ClothesRack = new hhgItem('Clothes Rack',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-coat-stand-livingroom-furniture', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var ClothesWasher = new hhgItem('Clothes Washer',15 ,0 ,0 ,0 ,'www.image.com', 'flaticon-washing-machine', ['Other Rooms'], 0 ,'none','none');
          var CoffeeMachine = new hhgItem('Coffee Machine',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-electric-kettle', ['kitchen'], 0 ,'none','none');
          var ComputerPrinter = new hhgItem('Computer Printer',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-studio-printing-machine', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study'], 0 ,'none','none');
          var ComputerPC = new hhgItem('PC Computer',12 ,0 ,0 ,0 ,'www.image.com', 'flaticon-electronic-visualization-monitor-tool-for-tv-or-computer', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study'], 0 ,'none','none');
          var Desk = new hhgItem('Desk',30 ,0 ,0 ,0 ,'www.image.com', 'flaticon-studio-desk-and-chair', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var DresserLarge = new hhgItem('Large Dresser',30 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-closet-with-opened-door-of-the-side-to-hang-clothes', ['Bedroom One', 'Bedroom Two', 'Master Bedroom'], 0 ,'none','none');
          var DresserMedium = new hhgItem('Medium Dresser',20 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-black-closed-closet-for-clothes', ['Bedroom One', 'Bedroom Two', 'Master Bedroom'], 0 ,'none','none');
          var DresserSmall = new hhgItem('Small Dresser',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-drawers-furniture', ['Bedroom One', 'Bedroom Two', 'Master Bedroom'], 0 ,'none','none');
          var FanFloor = new hhgItem('Floor Fan',8 ,0 ,0 ,0 ,'www.image.com', 'flaticon-fan', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var LampFloor = new hhgItem('Floor Lamp',8 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-lamp-1', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var LampTable = new hhgItem('Table Lamp',5 ,0 ,0 ,0 ,'www.image.com', 'flaticon-lamp', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var Mirror = new hhgItem('Mirror',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-square-framed-mirror', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Bathroom', 'Other Rooms'], 0 ,'fragile ','none');
          var PictureMedium = new hhgItem('Medium Picture',4 ,0 ,0 ,0 ,'www.image.com', 'flaticon-picture-with-frame-for-livingroom-decoration-of-house', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var PictureSmall = new hhgItem('Small Picture',2 ,0 ,0 ,0 ,'www.image.com', 'flaticon-picture-with-frame-for-livingroom-decoration-of-house', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var PlantSmall = new hhgItem('Small Plant',5 ,0 ,0 ,0 ,'www.image.com', 'flaticon-yard-tree-in-a-pot', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var RefrigeratorFreezer = new hhgItem('Refridgerator',30 ,0 ,0 ,0 ,'www.image.com', 'flaticon-refrigerator', ['kitchen', 'Other Rooms'], 0 ,'none','none');
          var Sofa1Str = new hhgItem('1 Seater Sofa',16 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-armchair-1', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var Sofa2Str = new hhgItem('2 Seater Sofa',40 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-black-double-sofa', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var Sofa3Str = new hhgItem('3 Seater Sofa',60 ,0 ,0 ,0 ,'www.image.com', 'flaticon-black-sofa-of-livingroom', ['Living Room' , 'Dining Room', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Other Rooms'], 0 ,'none','none');
          var StoolBarkitchen = new hhgItem('kitchen Stool',5 ,0 ,0 ,0 ,'www.image.com', 'flaticon-kitchen-small-bench', ['kitchen'], 0 ,'none','none');
          var TableDining = new hhgItem('Dining Table',30 ,0 ,0 ,0 ,'www.image.com', 'flaticon-dining-room-furniture-of-a-table-with-chairs', ['Dining Room', 'kitchen'], 0 ,'none','none');
          var TableLargeCoffee = new hhgItem('Large Coffee Table',20 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-table-with-a-small-jar', ['Living Room' , 'Dining Room'], 0 ,'none','none');
          var TableNight = new hhgItem('Night Table',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-bedroom-furniture-small-table-for-bed-side', ['Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');
          var TableSmallCoffee = new hhgItem('Small Coffee Tabe',10 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-table-with-a-small-jar', ['Living Room' , 'Dining Room'], 0 ,'none','none');
          var TelevisionCabinet = new hhgItem('Television Cabinet',25 ,0 ,0 ,0 ,'www.image.com', 'flaticon-livingroom-furniture', ['Living Room' , 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study'], 0 ,'none','none');
          var VacuumCleaner = new hhgItem('Vacuum Cleaner',6 ,0 ,0 ,0 ,'www.image.com', 'flaticon-vacuum', ['Living Room' , 'Dining Room', 'kitchen', 'Bedroom One', 'Bedroom Two', 'Master Bedroom', 'Study', 'Bathroom', 'Other Rooms'], 0 ,'none','none');


          // Declare master items display array & add items into the array.
          var itemDisplayArray = [];
          //itemDisplayArray.push(tv, bath, cube, paw, phone, pills, ambulance, archive);
          itemDisplayArray.push(Artificialplant, BabyCrib, BarbecueGrill, Basket,	BedDouble,	BedKing,	BedQueen,	BedSingle,	BookcaseLarge,	BookcaseMedium,	BookcaseSmall,	CabinetLarge,	CabinetMedium, CabinetSmall);
          itemDisplayArray.push(CartonDishpack,	CartonDishpackPotsPans,	CartonFlatWardrobe,	CartonLarge,	CartonMedium,	CartonSmall,	ChairArm,	ChairOfficeStudy,	ChairStraight,	ClothesRack,	ClothesWasher,	CoffeeMachine,	ComputerPrinter,	ComputerPC,	Desk,	DresserLarge);
          itemDisplayArray.push(DresserMedium,	DresserSmall,	FanFloor,	LampFloor,	LampTable,	Mirror,	PictureMedium,	PictureSmall,	PlantSmall,	RefrigeratorFreezer,	Sofa1Str,	Sofa2Str,	Sofa3Str,	StoolBarkitchen,	TableDining,	TableLargeCoffee,	TableNight,	TableSmallCoffee,	TelevisionCabinet,	VacuumCleaner);

          var finalDisplayBlock = [];
          var livingRoomfinalDisplayBlock =[];
          var diningfinalDisplayBlock = [];
          var kitchenfinalDisplayBlock = [];
          var bedroomOnefinalDisplayBlock = [];
          var bedroomTwofinalDisplayBlock = [];
          var masterBedroomfinalDisplayBlock = [];
          var studyfinalDisplayBlock = [];
          var bathRoomsfinalDisplayBlock = [];
          var otherRoomsfinalDisplayBlock = [];
          var masterDisplay = [];

          var livingRoomfinalDisplaycode = [];
          var diningfinalDisplaycode = [];
          var kitchenfinalDisplaycode = [];
          var studyfinalDisplaycode = [];
          var bedroomOnefinalDisplaycode = [];
          var bedroomTwofinalDisplaycode = [];
          var masterBedroomfinalDisplaycode = [];
          var studyfinalDisplaycode = [];
          var bathroomfinalDisplaycode = [];
          var otherRoomsfinalDisplaycode = [];


            //Iterate over the Master Items list, Sort and create new Object to push for each item to create a new "by room" list
            for(let i = 0; i < itemDisplayArray.length; i++){
              var room = itemDisplayArray[i].location;

                if((room.indexOf('Living Room') > -1)) {
                  var item1 = new hhgItem();
                  item1.name = itemDisplayArray[i].name;
                  item1.volume = itemDisplayArray[i].volume;
                  item1.height = itemDisplayArray[i].height;
                  item1.width = itemDisplayArray[i].width;
                  item1.depth = itemDisplayArray[i].depth;
                  item1.image = itemDisplayArray[i].image;
                  item1.icon = itemDisplayArray[i].icon;
                  item1.location = itemDisplayArray[i].location;
                  item1.quantity = itemDisplayArray[i].quantity;
                  item1.specialHandling = itemDisplayArray[i].specialHandling;
                  item1.color = itemDisplayArray[i].color;
                  item1.location ='Living Room';
                  livingRoomfinalDisplayBlock.push(item1);
                }
                if((room.indexOf('Dining Room') > -1)) {
                  var item2 = new hhgItem();
                  item2.name = itemDisplayArray[i].name;
                  item2.volume = itemDisplayArray[i].volume;
                  item2.height = itemDisplayArray[i].height;
                  item2.width = itemDisplayArray[i].width;
                  item2.depth = itemDisplayArray[i].depth;
                  item2.image = itemDisplayArray[i].image;
                  item2.icon = itemDisplayArray[i].icon;
                  item2.location = itemDisplayArray[i].location;
                  item2.quantity = itemDisplayArray[i].quantity;
                  item2.specialHandling = itemDisplayArray[i].specialHandling;
                  item2.color = itemDisplayArray[i].color;
                  item2.location ='Dining Room';
                  diningfinalDisplayBlock.push(item2);
                }
                if((room.indexOf('kitchen') > -1)) {
                  var item3 = new hhgItem();
                  item3.name = itemDisplayArray[i].name;
                  item3.volume = itemDisplayArray[i].volume;
                  item3.height = itemDisplayArray[i].height;
                  item3.width = itemDisplayArray[i].width;
                  item3.depth = itemDisplayArray[i].depth;
                  item3.image = itemDisplayArray[i].image;
                  item3.icon = itemDisplayArray[i].icon;
                  item3.location = itemDisplayArray[i].location;
                  item3.quantity = itemDisplayArray[i].quantity;
                  item3.specialHandling = itemDisplayArray[i].specialHandling;
                  item3.color = itemDisplayArray[i].color;
                  item3.location ='Kitchen';
                  kitchenfinalDisplayBlock.push(item3);
                }
                if((room.indexOf('Bedroom One') > -1)) {
                  var item4 = new hhgItem();
                  item4.name = itemDisplayArray[i].name;
                  item4.volume = itemDisplayArray[i].volume;
                  item4.height = itemDisplayArray[i].height;
                  item4.width = itemDisplayArray[i].width;
                  item4.depth = itemDisplayArray[i].depth;
                  item4.image = itemDisplayArray[i].image;
                  item4.icon = itemDisplayArray[i].icon;
                  item4.location = itemDisplayArray[i].location;
                  item4.quantity = itemDisplayArray[i].quantity;
                  item4.specialHandling = itemDisplayArray[i].specialHandling;
                  item4.color = itemDisplayArray[i].color;
                  item4.location ='Bedroom One';
                  bedroomOnefinalDisplayBlock.push(item4);
                }
                if((room.indexOf('Bedroom Two') > -1)) {
                  var item5 = new hhgItem();
                  item5.name = itemDisplayArray[i].name;
                  item5.volume = itemDisplayArray[i].volume;
                  item5.height = itemDisplayArray[i].height;
                  item5.width = itemDisplayArray[i].width;
                  item5.depth = itemDisplayArray[i].depth;
                  item5.image = itemDisplayArray[i].image;
                  item5.icon = itemDisplayArray[i].icon;
                  item5.location = itemDisplayArray[i].location;
                  item5.quantity = itemDisplayArray[i].quantity;
                  item5.specialHandling = itemDisplayArray[i].specialHandling;
                  item5.color = itemDisplayArray[i].color;
                  item5.location ='Bedroom Two';
                  bedroomTwofinalDisplayBlock.push(item5);
                }
                if((room.indexOf('Master Bedroom') > -1)) {
                  var item6 = new hhgItem();
                  item6.name = itemDisplayArray[i].name;
                  item6.volume = itemDisplayArray[i].volume;
                  item6.height = itemDisplayArray[i].height;
                  item6.width = itemDisplayArray[i].width;
                  item6.depth = itemDisplayArray[i].depth;
                  item6.image = itemDisplayArray[i].image;
                  item6.icon = itemDisplayArray[i].icon;
                  item6.location = itemDisplayArray[i].location;
                  item6.quantity = itemDisplayArray[i].quantity;
                  item6.specialHandling = itemDisplayArray[i].specialHandling;
                  item6.color = itemDisplayArray[i].color;
                  item6.location ='Master Bedroom';
                  masterBedroomfinalDisplayBlock.push(item6);
                }
                if((room.indexOf('Study') > -1)) {
                  var item7 = new hhgItem();
                  item7.name = itemDisplayArray[i].name;
                  item7.volume = itemDisplayArray[i].volume;
                  item7.height = itemDisplayArray[i].height;
                  item7.width = itemDisplayArray[i].width;
                  item7.depth = itemDisplayArray[i].depth;
                  item7.image = itemDisplayArray[i].image;
                  item7.icon = itemDisplayArray[i].icon;
                  item7.location = itemDisplayArray[i].location;
                  item7.quantity = itemDisplayArray[i].quantity;
                  item7.specialHandling = itemDisplayArray[i].specialHandling;
                  item7.color = itemDisplayArray[i].color;
                  item7.location ='Study';
                  studyfinalDisplayBlock.push(item7);
                }
                if((room.indexOf('Bathroom') > -1)) {
                  var item8 = new hhgItem();
                  item8.name = itemDisplayArray[i].name;
                  item8.volume = itemDisplayArray[i].volume;
                  item8.height = itemDisplayArray[i].height;
                  item8.width = itemDisplayArray[i].width;
                  item8.depth = itemDisplayArray[i].depth;
                  item8.image = itemDisplayArray[i].image;
                  item8.icon = itemDisplayArray[i].icon;
                  item8.location = itemDisplayArray[i].location;
                  item8.quantity = itemDisplayArray[i].quantity;
                  item8.specialHandling = itemDisplayArray[i].specialHandling;
                  item8.color = itemDisplayArray[i].color;
                  item8.location ='Bathroom';
                  bathRoomsfinalDisplayBlock.push(item8);
                }
                if((room.indexOf('Other Rooms') > -1)) {
                  var item9 = new hhgItem();
                  item9.name = itemDisplayArray[i].name;
                  item9.volume = itemDisplayArray[i].volume;
                  item9.height = itemDisplayArray[i].height;
                  item9.width = itemDisplayArray[i].width;
                  item9.depth = itemDisplayArray[i].depth;
                  item9.image = itemDisplayArray[i].image;
                  item9.icon = itemDisplayArray[i].icon;
                  item9.location = itemDisplayArray[i].location;
                  item9.quantity = itemDisplayArray[i].quantity;
                  item9.specialHandling = itemDisplayArray[i].specialHandling;
                  item9.color = itemDisplayArray[i].color;
                  item9.location ='Other Rooms';
                  otherRoomsfinalDisplayBlock.push(item9);
                }
            }

            // Compile into master array for looping later on...
            var masterDisplay =[];
            masterDisplay.push(livingRoomfinalDisplayBlock, diningfinalDisplayBlock, kitchenfinalDisplayBlock, bedroomOnefinalDisplayBlock, bedroomTwofinalDisplayBlock, masterBedroomfinalDisplayBlock, studyfinalDisplayBlock, bathRoomsfinalDisplayBlock, otherRoomsfinalDisplayBlock);


            for(let a = 0; a < masterDisplay.length; a++){
              let currentObject = masterDisplay[a];
              //console.log('Master Loop Round:' + a);

              for (let b = 0; b < currentObject.length; b++){
              //  console.log(currentObject[b]);
                let title = currentObject[b].name;
                let icon = currentObject[b].icon;
                let volume = currentObject[b].volume;
                let quantity = currentObject[b].quantity;
                let locale = currentObject[b].location;
                locale = locale.replace(/\s/g,'');
                var titleNoSpace = title.replace(/\s/g,'');

                let colBlock = "<div class='col-md-3 text-center' id="+title+"-"+locale+"> \
                  <div class='icon mt-5 "+icon+"'></div> \
                  <h5 class='text-info itemTitle'>"+title+"</h5><h5 class='text-info'><div class='qty' id='"+titleNoSpace+"-qty'>"+quantity+"</div><h5> \
                  <div class='btn-group'> \
                    <button type='button' class='btn bg-light plus' value="+volume+" name="+titleNoSpace+">+</button> \
                    <button type='button' class='btn bg-light minus' value="+volume+" name="+titleNoSpace+">-</button> \
                  </div> \
                </div>";

                  if(currentObject[b].location == 'Living Room'){
                  livingRoomfinalDisplaycode.push(colBlock);
                }
                  if(currentObject[b].location == 'Dining Room'){
                  diningfinalDisplaycode.push(colBlock);
                }
                  if(currentObject[b].location == 'Kitchen'){
                  kitchenfinalDisplaycode.push(colBlock);
                }
                  if(currentObject[b].location == 'Bedroom One'){
                  bedroomOnefinalDisplaycode.push(colBlock);
                }
                if(currentObject[b].location == 'Bedroom Two'){
                  bedroomTwofinalDisplaycode.push(colBlock);
                }
                if(currentObject[b].location == 'Master Bedroom'){
                  masterBedroomfinalDisplaycode.push(colBlock);
                }
                if(currentObject[b].location == 'Study'){
                  studyfinalDisplaycode.push(colBlock);
                }
                if(currentObject[b].location == 'Bathroom'){
                  bathroomfinalDisplaycode.push(colBlock);
                }
                if(currentObject[b].location == 'Other Rooms'){
                  otherRoomsfinalDisplaycode.push(colBlock);
                }

              }
            }

            // display on front end seperated into each room tab
            document.getElementById('livingRoomitemsTab').innerHTML = livingRoomfinalDisplaycode.join("");
            document.getElementById('diningRoomItemsTab').innerHTML = diningfinalDisplaycode.join("");
            document.getElementById('kitchenItemsTab').innerHTML = kitchenfinalDisplaycode.join("");
            document.getElementById('bedRoomOneItemsTab').innerHTML = bedroomOnefinalDisplaycode.join("");
            document.getElementById('bedRoomTwoItemsTab').innerHTML = bedroomTwofinalDisplaycode.join("");
            document.getElementById('masterBedRoomItemsTab').innerHTML = masterBedroomfinalDisplaycode.join("");
            document.getElementById('studyItemsTab').innerHTML = studyfinalDisplaycode.join("");
            document.getElementById('bathRoomsItemsTab').innerHTML = bathroomfinalDisplaycode.join("");
            document.getElementById('otherRoomsItemsTab').innerHTML = otherRoomsfinalDisplaycode.join("");

        }



        plusMinus();

        //Give functionality to the add(+) and subtract(-) buttons and calculate Total Estiamted Volume
        function plusMinus (){
            var total = 0;
            var addArray = document.getElementsByClassName("btn bg-light plus");
            var subtractArray = document.getElementsByClassName("btn bg-light minus");
            var quantityArray = document.getElementsByClassName('qty');
            console.log(quantityArray);
            // Add (+) button functionality
            for(var i = 0; i < addArray.length; i++){
              addArray[i].addEventListener("click", function(){
                let volCuft = parseInt(this.value);
                total = total + volCuft;
                document.getElementById("estVolumeCuft").innerHTML = total;
              //  console.log(volCuft);

              // ADD 1 and display indivdual item quantity count with each click
                var itemName = this.name;
                let updatedID = itemName + '-qty';
                let originalQty = document.getElementById(updatedID).innerHTML;
                originalQty = parseInt(originalQty);
                let updatedQty = originalQty + 1;
                document.getElementById(updatedID).innerHTML = updatedQty;

              });
            }

            // Add (-) button functionality
            for(var i = 0; i < subtractArray.length; i++){
              subtractArray[i].addEventListener("click", function(){
                let volCuft = parseInt(this.value);
                total = total - volCuft;

                var itemName = this.name;
                let updatedID = itemName + '-qty';
                let originalQty = document.getElementById(updatedID).innerHTML;
                originalQty = parseInt(originalQty);
                var updatedQty;
                if (originalQty <= 0){
                   updatedQty = 0;
                } else {
                   updatedQty = originalQty - 1;
                }
                document.getElementById(updatedID).innerHTML = updatedQty;


                if(total <= 0){
                  total = 0;
                  document.getElementById("estVolumeCuft").innerHTML =  total;
                } else {
                  document.getElementById("estVolumeCuft").innerHTML =  total;
                }
              });
            }

        }

        function AddressObject (city, district, road, roadtype, section, lane, alley, number, floor, elevator) {
          this.city = city;
          this.district = district;
          this.road = road;
          this.roadtype =roadtype;
          this.section = section;
          this.lane = lane;
          this.alley = alley;
          this.number = number;
          this.floor = floor;
          this.elevator = elevator;
        }

        var oaAddressObject = new AddressObject();
        // Address Object updating function
        function updateAddress(){
          var finalPickupAddress = document.getElementById('pickupAddress').value;

          document.getElementById('origin').innerHTML = finalPickupAddress;
        }

        var daAddressObject = new AddressObject();
        // Address Object updating function
        function updateDaAddress(){
          var finalDeliveryAddress =document.getElementById('deliveryAddress').value;
          document.getElementById('destination').innerHTML = finalDeliveryAddress;

        }


      function geocode(){
        console.log('Geocode Ran');
        var beginLocation = document.getElementById('pickupAddress').value;
        axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
          params: {
            address: beginLocation,
            key:'AIzaSyAYIFu6sIHnywmXf9QaPrQ_986ReZpnSz0'
          }
        })
        .then(function(response){
          var mapStartPointLat = response.data.results[0].geometry.location.lat;
          var mapStartPointLng = response.data.results[0].geometry.location.lng;
          console.log(response);
          document.getElementById('finalOriginAddressInputLAT').setAttribute("value", mapStartPointLat);
          document.getElementById('finalOriginAddressInputLONG').setAttribute("value", mapStartPointLng);
        })
        .catch(function(error){
          console.log(error);
        })
      }

      // Let's load this mother fucker LIVE...initate map and call directions servces, pull to variables from pickup and delivery address
      function initMap(){
        console.log('init map ran');
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {lat: 25.0330, lng: 121.565}
        });
        directionsDisplay.setMap(map);

        var onChangeHandler = function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        };

        document.getElementById('pickupAddress').addEventListener('change', function(){
          geocode();
        });

        document.getElementById('bannerbutton').addEventListener('click', onChangeHandler);
      };


            function calculateAndDisplayRoute(directionsService, directionsDisplay) {
              directionsService.route({
                origin: document.getElementById('pickupAddress').value,
                destination: document.getElementById('deliveryAddress').value,
                travelMode: 'DRIVING'
              }, function(response, status) {
                if (status === 'OK') {
                  directionsDisplay.setDirections(response);
                  console.log(response);
                } else {
                  window.alert('Address(s) not found, please try to re-enter. ' + status);
                  document.getElementById("pickupAddress").reset();
                  document.getElementById("deliveryAddress").reset();
                }
              });
            }

            // document.getElementById('moveSubmitButton').addEventListener('click', function(){
            //   var scroll = document.getElementById('moveDetails');
            //   scroll.scrollIntoView({behavior: "smooth", block: "start", inline: "center"});
            // });

            //Add event listener to Move Button to dynamically set the Orgin and Destination Locations
             document.getElementById('deliveryFloor').addEventListener('change', function(e){
                        e.preventDefault();

                        // Pull Pickup and Destination locations, , return and store into variables
                        var origin1 = document.getElementById('pickupAddress').value;
                        var destinationA = document.getElementById('deliveryAddress').value;

                    // Send info to Google API for time and distance
                    var service = new google.maps.DistanceMatrixService();
                    service.getDistanceMatrix(
                      {
                        origins: [origin1],
                        destinations: [destinationA],
                        travelMode: 'DRIVING',
                        drivingOptions: {
                              departureTime: new Date(Date.now()),
                              trafficModel: 'optimistic'
                            },
                        avoidHighways: false,
                        avoidTolls: false,
                      }, callback);

                    //Parse the returned Object out, specifically retrieving distance and duration -> rounding up to nearest whole integer, displaying in appropriate DIV on front end
                    function callback(response, status) {
                        if (status == 'OK') {
                        var origins = response.originAddresses;
                        var destinations = response.destinationAddresses;
                        for (var i = 0; i < origins.length; i++) {
                          var results = response.rows[i].elements;
                          for (var j = 0; j < results.length; j++) {
                            var element = results[j];
                            var distanceKm = Math.round(element.distance.value / 1000);
                            var duration = element.duration.value / 3600
                            //console.log(duration);
                            var durationHrs = Math.floor(duration);
                            var durationMins = Math.round((duration % 1) * 60);
                            var from = origins[i];
                            var to = destinations[j];
                            document.getElementById('distance').innerHTML = addCommas(distanceKm);
                            document.getElementById('timeHrs').innerHTML = durationHrs;
                            document.getElementById('timeMins').innerHTML = durationMins;
                            document.getElementById('finalTravelhrs').value = durationHrs;
                            document.getElementById('finalTravelTimemins').value = durationMins;
                            document.getElementById('origin').innerHTML = document.getElementById('pickupAddress').value;
                            document.getElementById('destination').innerHTML = document.getElementById('deliveryAddress').value;
                          }
                        }
                      }
                    }
              });



        // BEGIN THE SUBMISSION process

        var finalLivingRoomSubmitItemList =[];


          document.getElementById('submitInventoryButton').addEventListener('click', function(){

                      finalLivingRoomSubmitItemList = [];
                      var inventoryListFirstLine = "<li class='card-header'><Strong>Final Item Inventory | 物品清單</strong></li>";
                      var inventoryListLastLine = "<li class='card-header' id='finalInventoryFormVolume'> </li>";
                      finalLivingRoomSubmitItemList.push(inventoryListFirstLine);
                      var tabContainer = document.querySelector("#livingRoomitemsTab");
                      var matches = tabContainer.querySelectorAll("div.col-md-3");
                      console.log(matches);
                      for(var div = 0; div < matches.length; div++){
                        var innerItemName = matches[div].children[1].innerHTML;
                        var innerItemQuantity = matches[div].querySelector(".qty").innerHTML;
                          if( innerItemQuantity > 0){
                              var listItemcode = "<li class='list-group-item'>"+innerItemName.toUpperCase()+" x "+innerItemQuantity+"</li>";
                              finalLivingRoomSubmitItemList.push(listItemcode);
                          }
                      }

                      finalLivingRoomSubmitItemList.push(inventoryListLastLine);
                      var finalVolume = document.getElementById("estVolumeCuft").innerHTML;
                      var truckEstimate = finalVolume / 200;
                      var finalOrigin = document.getElementById("origin").innerHTML;
                      var finalDestination =document.getElementById("destination").innerHTML;
                      var finalDistanceKm =document.getElementById("distance").innerHTML;
                      // var finalTravelTime =document.getElementById("time").innerHTML;
                      var finalTravelTimeHrs =document.getElementById("timeHrs").innerHTML;
                      var finalTravelTimeMins =document.getElementById("timeMins").innerHTML;

                      // Set the final details into the pop-up confirmation form
                      document.getElementById('inventoryItemsFinalList').innerHTML = finalLivingRoomSubmitItemList.join('');
                      document.getElementById('finalInventoryFormVolume').innerHTML = "<strong>Final Volume (cuft):</strong> "+finalVolume;
                      //document.getElementById('finalVolTitle').innerHTML = "<h2 id='finalInventoryHeader' class='text-secondary'>Final Move Details<span style='text-warning' font-size='14px'><p id='titleVol'>["+finalVolume+" cubic feet]</h4></span></h2>";
                      document.getElementById('volumeFinal').innerHTML = document.getElementById("estVolumeCuft").innerHTML;
                      document.getElementById('finalTrucks').innerHTML = truckEstimate;
                      document.getElementById('originFinal').innerHTML = finalOrigin;
                      document.getElementById('destinationFinal').innerHTML = finalDestination;
                      document.getElementById('distanceFinal').innerHTML = finalDistanceKm;
                      document.getElementById('timeFinalHrs').innerHTML = finalTravelTimeHrs;
                      document.getElementById('timeFinalMins').innerHTML = finalTravelTimeMins;

                      // fill the hidden form details values
                      document.getElementById('mainCit').value = document.getElementById('pickupAddress').value;
                      document.getElementById('finalVolumeInput').value = finalVolume;
                      document.getElementById('finalOriginAddressInput').value = finalOrigin;
                      document.getElementById('finalDestinationAddressInput').value = finalDestination;
                      document.getElementById('finalDistanceInput').value = finalDistanceKm;
                      document.getElementById('finalTravelhrs').value = finalTravelTimeHrs;
                      document.getElementById('finalTravelTimemins').value = finalTravelTimeMins;

                  });

                  function valueFunc(checked_id) {
                      // Get the checkbox
                      var checkBox = document.getElementById(checked_id);

                      // If the checkbox is checked, display the output text
                      if (checkBox.checked == true){
                        document.getElementById(checked_id).value = 'yes';
                      } else {
                        document.getElementById(checked_id).value = 'none';
                      }

                    }

                // document.getElementById('finalSubmitbtn').addEventListener('mouseover', function(){
                //   // Fill the hidden form accessory services values
                //
                //   document.getElementById('cratefinal').value = document.getElementById('cratingRequired').value;
                //   document.getElementById('hoistfinal').value = document.getElementById('hoistingNeeded').value;
                //   document.getElementById('cartonfinal').setAttribute("value", document.getElementById('cartonDrop').value);
                //   document.getElementById('cartonfinal').innerHTML = document.getElementById('cartonDrop').value;
                //   document.getElementById('picturehangfinal').setAttribute("value", document.getElementById('pictureHanging').value);
                //   document.getElementById('picturehangfinal').innerHTML = document.getElementById('pictureHanging').value;
                //   document.getElementById('longcarryfinal').setAttribute("value", document.getElementById('longCarry').value);
                //   document.getElementById('longcarryfinal').innerHTML = document.getElementById('longCarry').value;
                //   document.getElementById('staircarryfinal').setAttribute("value",document.getElementById('stairCarry').value);
                //   document.getElementById('staircarryfinal').innerHTML = document.getElementById('stairCarry').value;
                //   document.getElementById('holidayfinal').setAttribute("value",document.getElementById('overTime').value);
                //   document.getElementById('holidayfinal').innerHTML = document.getElementById('overTime').value;
                //   document.getElementById('grandpianofinal').setAttribute("value", document.getElementById('grandPiano').value);
                //   document.getElementById('grandpianofinal').innerHTML = document.getElementById('grandPiano').value;
                //   document.getElementById('uprightpianofinal').setAttribute("value", document.getElementById('uprightPiano').value);
                //   document.getElementById('uprightpianofinal').innerHTML = document.getElementById('uprightPiano').value;
                //   document.getElementById('nopackfinal').setAttribute("value", document.getElementById('noPacking').value);
                //   document.getElementById('nopackfinal').innerHTML = document.getElementById('noPacking').value;
                //   document.getElementById('nounpackfinal').setAttribute("value", document.getElementById('noUnpacking').value);
                //   document.getElementById('nounpackfinal').innerHTML = document.getElementById('noUnpacking').value;
                //   var finallist = document.getElementById('inventoryItemsFinalList').innerHTML;
                //   console.log(finallist);
                //   document.getElementById('inventoryList').setAttribute("value", finallist);
                // });
