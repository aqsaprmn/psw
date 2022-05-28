// Akses Blockir kembali halaman semula
const backPage = document.querySelector("#backPage");
if (backPage) {
	backPage.addEventListener("click", function (e) {
		e.preventDefault();
		e.stopPropagation();

		window.history.back();
	});
}

const menu = document.querySelectorAll("li.nav-item");

menu.forEach((val, key, arr) => {
	val.addEventListener("click", function () {
		const subMenuA = this.querySelector("a[data-toggle='collapse']");
		if (subMenuA) {
			for (let i = 0; i < menu.length; i++) {
				const menuI = menu[i];
				const subMenuAI = menuI.querySelector("a[data-toggle='collapse']");

				if (subMenuAI) {
					const subMenuDivAi = subMenuAI.nextElementSibling;

					if (i == key) {
						subMenuAI.classList.toggle("collapsed");

						subMenuDivAi.classList.toggle("show");

						subMenuAI.getAttribute("aria-expanded") == "true"
							? "false"
							: "true";
					} else {
						subMenuAI.classList.add("collapsed");

						subMenuDivAi.classList.remove("show");

						subMenuAI.setAttribute("aria-expanded", "true");
					}
				}
			}
		}
	});

	// const subMenuA = val.querySelector("a[data-toggle='collapse']");
	// if (subMenuA) {
	// 	const subMenuDiv = subMenuA.nextElementSibling;
	// 	const subMenuDivA = subMenuDiv.querySelectorAll("a");

	// 	subMenuDivA.forEach((val) => {
	// 		val.addEventListener("click", function () {
	// 			if (subMenuA.classList.contains("collapsed")) {
	// 				subMenuA.classList.remove("collapsed");

	// 				subMenuDiv.classList.add("show");

	// 				subMenuA.setAttribute("aria-expanded", "false");
	// 			}
	// 		});
	// 	});
	// }
});
