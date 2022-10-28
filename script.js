const characters = document.getElementsByTagName('characters')
const form = document.getElementsByTagName('PassGenForm')
const addUC = document.getElementsByTagName('addUC')
const addLC = document.getElementsByTagName('addLC')
const addS = document.getElementsByTagName('addS')
const PassDis = document.getElementsByTagName('PassDis')

const UPPERCASE_CHAR_CODES = arrayarrange(65,90)
const LOWERCASE_CHAR_CODES = arrayarrange(97,122)
const NUMBER_CHAR_CODES= arrayarrange(48,57)
const SYMBOL_CHAR_CODES = arrayarrange(33,47).concat(arrayarrange(58,64)).concat(arrayarrange(91,96)).concat(arrayarrange(123,126))


characters.addeventlistener('input', syncCharacters)


form.addeventlistener('submit',e=>{
	e.preventDefault()
	const characters= characters.value
	const addUC = addUC.checked
	const addLC = addLC.checked
	const addS = addS.checked
	const password = generatePassword(characters,addUC,addLC,addS)
	PassDis.innertext = password

})
function generatePassword(characters,addUC,addLC,addS){
	let charCodes= LOWERCASE_CHAR_CODES //by default let it be lower case 
    if (addUC) charCodes= charCodes.concat(UPPERCASE_CHAR_CODES)

    if (addS) charCodes= charCodes.concat(SYMBOL_CHAR_CODES)
    if (characters) charCodes= charCodes.concat(NUMBER_CHAR_CODES)

    const passChar=[]
for (let i=0;i<characters;i++){
	const characterCode= charCodes[Math.floor(Math.random()*charCodes.length)]
	passChar.push(String.fromCharCode(characterCode))
}
return passChar.join('')
}

function arrayarrange(l,h){
	const a = []
	for (let i=l;i<=h;i++){
		a.push(i)
	}
	return a
}




function syncCharacters(e{
	const value = e.target.value
	characters.value= value
})
