'use strict';

const fs = require('fs');

function solution(longStrings, wordFile) {
    fs.readFile(wordFile, (err, data) => {
        if (err) {throw err;}
        let wordIndex = new Map();
        data.toString().split("\r\n").forEach((value) => {
            wordIndex.set(value);
        });
        let suffixIndex = new Map();
        wordIndex.forEach((value, key) => {
            if (key.length > 1) {
                let total = key.length;
                let suffix = key[total-2] + key[total-1];
                if (suffixIndex.has(suffix)) {
                    let newValue = suffixIndex.get(suffix);
                    newValue.push(key);
                    suffixIndex.set(suffix, newValue);
                }
                else {
                    suffixIndex.set(suffix, [key]);
                }
            }
        });
        longStrings.forEach((longString) => {
            console.log(parseString(longString, wordIndex, suffixIndex));
        });
    });
}

function parseString(longString, wordIndex, suffixIndex) {
    let strL = longString.length;
    let lastPos = strL-1;
    let parsedString = '';
    let x = lastPos;
    let wordLastAdded = true;
    while (x > 0) {
        let suffix = [x-1,x];
        let myCache = new Map();
        let wordFound = findViaPrefix(suffix, longString, wordIndex, suffixIndex,myCache);
        if (wordFound !== null) {
            //console.log('Found word: ', wordFound);
            parsedString = wordFound + ' ' + parsedString;
            x -= wordFound.length;
            wordLastAdded = true;
        }
        else {
            if (wordLastAdded) {parsedString = ' ' + parsedString;}
            parsedString = longString[x] + parsedString;
            x--;
            wordLastAdded = false;
        }
        if (x === 0) {
            if (wordIndex.has(longString[x])) {
                parsedString = longString[x] + ' ' + parsedString;
            }
            else {
                if (wordLastAdded) {parsedString = ' ' + parsedString;}
                parsedString = longString[x] +  parsedString;
            }
        }
    }
    return parsedString;
}

function findViaPrefix(suffix, longString, wordIndex, suffixIndex, myCache) {
    let suffixValue = longString[suffix[0]] + longString[suffix[1]];
    let match = null;
    if (suffixIndex.has(suffixValue)) {
        if (!myCache.has(suffixValue)) {
            let sorted = suffixIndex.get(suffixValue);
            sorted.sort((val1, val2) => {
                if (val1.length === val2.length) {return 0}
                else if (val1.length > val2.length) {return -1}
                else {return 1}
            });
            myCache.set(suffixValue, sorted);
        }
        let candidates = myCache.get(suffixValue);
        //console.log(suffixValue, candidates.length, candidates[0]);
        let total = candidates.length;
        for (let x=0; x<total; x++) {
            if (candidates[x].length > suffix[1] + 1) {continue;}
            //console.log(candidates[x], longString.slice(suffix[1]+1 - candidates[x].length, suffix[1]+1));
            if (candidates[x] === longString.slice(suffix[1]+1 - candidates[x].length, suffix[1]+1)) {
                match = candidates[x];
                break;
            }
        }
        if (match === null
          && wordIndex.has(longString[suffix[1]])) {
            match = longString[suffix[1]];
        }
    }
    return match;
}


solution([
    'thequickbrownfoxjumpsoverthelazydog'
    ,'iamking'
    ,'iliketoeatalotofpie'
    ,'mypoolneedsalotofcleaning'
    ,'ilovetoplaytheguitarsomuchicouldfart'
    ,'iliketoworkonmygardenontheweekends'
    ,'ibuiltmyownplayground'
], __dirname + '/words_alpha.txt');
