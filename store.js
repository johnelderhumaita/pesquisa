{
    
}
if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

//remover carrinho==========
function ready() {
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for (var i = 0; i < removeCartItemButtons.length; i++) {
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

//quantidade carrinho==========
    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for (var i = 0; i < quantityInputs.length; i++) {
        var input = quantityInputs[i]
        input.addEventListener('change', quantityChanged)
    }
//adicionar ao carrinho==========
    var addToCartButtons = document.getElementsByClassName('shop-item-button')
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i]
        button.addEventListener('click', addToCartClicked)
    }

    document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)
}

//Botão salvar produtos==========
function purchaseClicked() {
    alert('Obrigado por sua compra')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    while (cartItems.hasChildNodes()) {
        cartItems.remover(cartItems.firstChild)
    }
    updateCartTotal()
}

//remover carrinho==========
function removeCartItem(event) {
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

//quantidade no carrinho==========
function quantityChanged(event) {
    var input = event.target
    if (isNaN(input.value) || input.value <= 0) {
        input.value == 1
    }
    updateCartTotal()
}

//pesquisa dos produtos==========
function addToCartClicked(event) {
    var button = event.target
    var shopItem = button.parentElement.parentElement
    var nome = shopItem.getElementsByClassName('shop-item-nome')[0].innerText
    var nomeproduto = shopItem.getElementsByClassName('shop-item-nomeproduto')[0].innerText
    var descricao = shopItem.getElementsByClassName('shop-item-descricao')[0].innerText
    var preco = shopItem.getElementsByClassName('shop-item-price')[0].innerText
    addItemToCart(nome, nomeproduto, descricao, preco)
    updateCartTotal()
}

//Itens na lista de compras ==========
function addItemToCart(nome, nomeproduto, descricao, preco) {
    var cartRow = document.createElement('div')
    cartRow.classList.add('cart-row')
    var cartItems = document.getElementsByClassName('cart-items')[0]
    var cartItemNames = cartItems.getElementsByClassName('cart-item-nome')
    var cartItemNames = cartItems.getElementsByClassName('cart-item-produto')
    for (var i = 0; i < cartItemNames.length; i++) {
        if (cartItemNames[i].innerText == nomeproduto) {
            alert('Produto semelhante já adicionado.')
            return
        }
    }
    var cartRowContents = `

        <div class="cart-item cart-column">
            <ul class="list-unstyled">
               <small  class="cart-item-nome text-primary" style="width: 100%;">${nome}</small>
              <li><p class="cart-item-produto">${nomeproduto}</p></li>
            </ul>
        </div>
   
        <span class="cart-price cart-column">${preco}</span>

        <div class="cart-quantity cart-column">
            <input class="cart-quantity-input" type="number" value="1">
            <i class="fas fa-trash btn btn-danger float-right"></i>
        </div>

                            `
    cartRow.innerHTML = cartRowContents
    cartItems.append(cartRow)
    cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
    cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
}

//calculo total da lista de compras==========
function updateCartTotal() {
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for (var i = 0; i < cartRows.length; i++) {
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('$', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = 'R$ ' + total
}
