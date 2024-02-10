<style type="text/css">
  body{
 background: #ddd;
}

/* Some csss reboot */
ul, li{
  margin: 0;
  padding: 0;
  list-style-type: none;
}

/* Container */
div { 
  position: relative;
  width: 100%;
  overflow-x: hidden;
  transform: transitionX(0);
}

/* Preview/Next Buttons */
b {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  left: 0.5em;
  width: 20px;
  height: 20x;
  line-height: 20px;
  font-size: 1.2em;
  color: #666;
  cursor: pointer;
  transform: translateY(-50%) scale(1);
  transition: transform .1s ease-out;
}

b:last-child {
  left: unset;
  right: 0.5em;
}

/* Button animation on hover */
b:hover{
  transform: translateY(-50%) scale(1.3);
}

/* Slider */
ul {
  position: relative;
  padding: 2em 0;
  display: flex;
  width: 100%;
  height: 150px;
  transform: translateX(0);
  transition: transform .3s ease-out;
}

/* Items */
li {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 4em;
  font-weight: 500;
  font-family: arial;
  color: #555;
  min-width: calc(100% / 3);
  background: #fff;
  border-radius: .5em;
  /* Animation */
  transform: translateX(10%) scale(0.5);
  box-shadow: 0 2px 2px 0 rgb(0 0 0 / 14%), 0 3px 1px -2px rgb(0 0 0 / 12%), 0 1px 5px 0 rgb(0 0 0 / 20%);
  transition: all .3s ease-out;
}

/* Featured Item */
.featured {
  z-index: 1;
  /* Animation  */
  transform: scale(1);
  box-shadow: 0 16px 24px 2px rgb(0 0 0 / 14%), 0 6px 30px 5px rgb(0 0 0 / 12%), 0 8px 10px -7px rgb(0 0 0 / 20%)
}

.featured + li {
  /* Offset the next element under the selected element */
  transform: scale(.5) translateX(-25%) !important;
}
</style>

<div>            <!-- Container -->
  <ul>           <!-- Slider -->
    <li>1</li>   <!-- Ithems -->
    <li class="featured">2</li>  
    <li>3</li>
    <li>4</li>  
    <li>5</li>  
    <li>6</li>  
    <li>7</li>  
    <li>8</li>  
    <li>9</li>  
    <li>10</li>  
  </ul>
  <b>ᐸ</b>       <!-- Preview button -->
  <b>ᐳ</b>       <!-- Next button -->
</div>

<script type="text/javascript">
  // Button click events
const buttons = document.querySelectorAll('b')
buttons.forEach((button, i) => 
  button.onclick = () => slide(i)
)

// Slide function
function slide(right) {
  // Get the SLider elements
  const container = document.querySelector('div');
  const slider = document.querySelector('ul');
  const items = document.querySelectorAll('li');
  const featured = document.querySelector('.featured');
  
  // Get the featured item
  const featuredIndex = [...items].indexOf(featured);
  
  // Set the move if not right then left
  const move = right ? 1 : -1;
  
  // Check the slider limits 
  // if right and index 0: do nothing 
  // if left and last item: do nothing
  if((!right && !featuredIndex) 
   || (right && featuredIndex === items.length -1))
    return;

  // Get the next item element
  const nextIndex = featuredIndex + move;
  const nextItem = items[nextIndex]
  
  // Remove "featured" class from last item 
  featured.classList.remove("featured");
  
  // Add "featured" class the next item
  nextItem.classList.add("featured");
  
  // Get the container size 
  const { width: containerSize } = container.getBoundingClientRect();
  
  // Get the next item size and position
  const itemSize = containerSize / 3; // Display only 3 items 
  const itemPosition = itemSize * (nextIndex + 1); // Current position
  
  // Compute the slider next position
  const position = containerSize - itemPosition - itemSize;
  
  // Move the slider on its X axis using css transform and transitionX
  slider.style.transform = `translateX(${position}px)`
}
</script>
