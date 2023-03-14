var requestPromise = require('request-promise');
var request = require('request');
const jsdom = require("jsdom");
const { JSDOM } = jsdom;

// change log style/color
let lc = {
    N : '\033[0m',  //NORMAL
    G: '\033[92m',  //GREEN
    Y : '\033[93m', //YELLOW
    R : '\033[91m', //RED
    P : '\033[95m', //PURPLE
    B : '\033[94m', //BLUE
    C : '\033[96m', //CYAN
    B : '\033[1m',  //BOLD
    U : '\033[4m'   //UNDERLINE
}

function fetchData(el){
    let item = new Object

    item.fullName = el.querySelector('strong.product.name').textContent.replaceAll(/\n  |  /g,"")

    if( item.fullName.match(/[0-9]+YO/g) ) item.age = (item.fullName.match(/[0-9]+YO/g)+"").slice(0,-2)
    else item.age = null

    if( item.fullName.match(/[0-9][lL]|[0-9],[0-9]+[lL]| 0,[0-9]+/g) ) item.capacity = (item.fullName.match(/[0-9][lL]|[0-9],[0-9]+[lL]| 0,[0-9]+/g)+"").replaceAll(',','.').replaceAll('l','').replaceAll('L','')
    else item.capacity = null

    item.price = el.querySelector('span.price').textContent.replaceAll(/,/g,'.').replaceAll(/\s/g,'').replaceAll(/zł/g,'')
 
    item.unitPrice = item.price/(item.capacity*item.age*10)
    if(item.unitPrice==Infinity) item.unitPrice = null

    return item
}

async function main(){
    let url = "https://www.forfiterexclusive.pl/whisky"
    const product_list_limit = 36
    let dom = new JSDOM( await requestPromise(url+"/?product_list_limit="+product_list_limit) )
    const NOPages = parseInt(dom.window.document.querySelectorAll("main .toolbar ul li")[4].querySelectorAll("span")[1].textContent)
    console.log(`${lc.G}${url}${lc.N} has ${lc.G}${NOPages}${lc.N} pages to search 🌴`)

    process.stdout.write('['); for(var i=1;i<=NOPages;i++)process.stdout.write('■'); process.stdout.write(']')
    process.stdout.cursorTo(1)   

    let result = []

    for( var i=1; i<=NOPages; i++ ){
        process.stdout.cursorTo(i)
        process.stdout.write(lc.G)
        process.stdout.write('■')
        process.stdout.cursorTo(NOPages+3)
        process.stdout.write( Math.floor(100*i/NOPages)+"%")
        process.stdout.write(lc.N)
        process.stdout.cursorTo(i)

        let dom = new JSDOM( await requestPromise(url+"/?p="+i+"&product_list_limit="+product_list_limit) )

        let elements = dom.window.document.querySelectorAll('main ol li.item.product')
        for( const el of elements ){
            item =  fetchData(el)
            if(item.unitPrice!=null) 
                result.push(item)
        }
    }        
    process.stdout.write("\n")

    result.sort((a,b) =>  a.unitPrice - b.unitPrice )

    console.log(  "ID".padEnd(5," ") + "NAME".padEnd(80," ") + "UNIT-PRICE"  )
    for( const el of result ){
        process.stdout.write(  (Array.from(result).indexOf(el)+1+". ").padEnd(5," ")  )
        process.stdout.write(  el.fullName.padEnd(80," ")  )
        process.stdout.write(  Math.round(el.unitPrice*10**5)/10**5+" PLN\n"  )
    }
    console.log(  lc.G + "UNITPRICE = PRICE / (CAPACITY*AGE*10)" + lc.N  )
}
main()