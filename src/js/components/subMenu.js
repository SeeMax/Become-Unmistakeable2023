export let subMenu = () => {
  // Get all elements with class "menu-item-has-children"
  var menuItemsWithChildren = document.querySelectorAll(".menu-item-has-children");

  // Loop through each element with the class "menu-item-has-children"
  menuItemsWithChildren.forEach(function (menuItem) {
    // Get the x position of the current element
    var xPosition = menuItem.offsetLeft;
    // Find the next sibling element with class "sub-menu"
    var subMenu = menuItem.nextElementSibling;
    // Check if the next sibling is a "sub-menu" element
    if (subMenu && subMenu.classList.contains("sub-menu")) {
      // Set the x position of the "sub-menu" element
      subMenu.style.left = xPosition + "px";
    }
  });

  var currentOpenSubmenu = null;
  var isAnimating = false; // Flag to prevent rapid opening/closing

  // Debounce function
  function debounce(callback, delay) {
    var timer;
    return function () {
      clearTimeout(timer);
      timer = setTimeout(callback, delay);
    };
  }

  // Function to close the submenu
  function closeSubmenu(submenu, menuItem) {
    gsap.to(submenu, { height: 0, duration: 0.3, ease: "linear" });
    submenu.classList.remove("openSubMenu");
    menuItem.classList.remove("openSubMenu");
  }

  menuItemsWithChildren.forEach(function (menuItem) {
    var submenu = menuItem.nextElementSibling;
    var submenuItems = submenu.querySelectorAll("a");

    menuItem.addEventListener(
      "mouseenter",
      debounce(function () {
        // Check if the submenu is already open or animating
        if (isAnimating || currentOpenSubmenu === submenu) return;

        // Close the currently open submenu
        if (currentOpenSubmenu) {
          closeSubmenu(currentOpenSubmenu, currentOpenSubmenu.previousElementSibling);
        }

        // Get the total height of the submenu, including margin and padding
        var totalHeight = Array.from(submenuItems).reduce(function (accumulator, childElement) {
          var styles = getComputedStyle(childElement);
          return (
            accumulator + childElement.offsetHeight + parseInt(styles.marginTop) + parseInt(styles.marginBottom) + parseInt(styles.paddingTop) + parseInt(styles.paddingBottom)
          );
        }, 0);

        // Animate the submenu to the calculated total height of its child elements
        gsap.to(submenu, {
          height: totalHeight,
          duration: 0.3,
          ease: "linear",
          onStart: function () {
            isAnimating = true;
          },
          onComplete: function () {
            submenu.classList.add("openSubMenu"); // Add the class to the opened submenu
            menuItem.classList.add("openSubMenu"); // Add the class to the hovered menu item
            currentOpenSubmenu = submenu; // Track the currently open submenu
            isAnimating = false;
          },
        });
      }, 200) // Adjust the debounce delay as needed
    );

    // Add mouseleave event to hide the submenu when mouse leaves submenu items or menu item
    menuItem.addEventListener("mouseleave", function (e) {
      var relatedTarget = e.relatedTarget;

      // Check if the mouse leaves the submenu or the menu item
      if (!submenu.contains(relatedTarget) && relatedTarget !== menuItem) {
        closeSubmenu(submenu, menuItem);
        currentOpenSubmenu = null; // Reset the currently open submenu
      }
    });
  });

  // Add a document-wide mousemove event listener to detect leaving openSubMenu items from the bottom, left, or right
  document.addEventListener("mousemove", function (e) {
    if (currentOpenSubmenu) {
      var mouseX = e.clientX;
      var mouseY = e.clientY;
      var submenuRect = currentOpenSubmenu.getBoundingClientRect();

      // Check if the mouse leaves the submenu to the left, right, or bottom
      if (mouseX < submenuRect.left || mouseX > submenuRect.right || mouseY > submenuRect.bottom) {
        closeSubmenu(currentOpenSubmenu, currentOpenSubmenu.previousElementSibling);
        currentOpenSubmenu = null; // Reset the currently open submenu
      }
    }
  });
};
