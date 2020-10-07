'use strict';

const fs = require('fs');

function solution(longStrings, wordFile) {
    fs.readFile(wordFile, (err, data) => {
        if (err) {throw err;}
        
        // Create word index by looping through
        // each word in the file and
        // adding to map
        let wordIndex = new Map();
        data.toString().split("\r\n").forEach((value) => {
            wordIndex.set(value);
        });

        // Create a suffix index from the
        // word index
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
        let myCache = new Map();
        longStrings.forEach((longString) => {
            console.log(longString);
            let parsed = '';
            parseString(longString, wordIndex, suffixIndex,myCache)
                .forEach((value) => {
                    parsed = value + ' ' + parsed;
                });
            console.log('=' + parsed);
        });
    });
}

function parseString(longString, wordIndex, suffixIndex, myCache) {
    let strL = longString.length;
    let lastPos = strL-1;
    let x = lastPos;
    let suffix = [x-1,x];
    let matches = [];
    let nomatch = '';
    while (x >= 0) {
        suffix = [x-1, x];
        let result = findViaPrefix(suffix, longString, wordIndex, suffixIndex,myCache);
        if (result.length > 0) {
            if (nomatch.length) {
                matches = matches.concat([nomatch]);
                nomatch = '';
            }
            matches = matches.concat(result);
            let total = result.reduce((accum, value) => {
                return accum + value.length;
            }, 0);
            x -= total;
        }
        else {
            nomatch = longString[x] + nomatch;
            x--;
        }
    }
    if (nomatch.length) {
        matches = matches.concat([nomatch]);
    }
    return matches;
}

function findViaPrefix(suffix, longString, wordIndex, suffixIndex, myCache, greedy = true) {
    let suffixValue = longString[suffix[0]] + longString[suffix[1]];
    let match = null;
    let matches = [];
    if (suffixIndex.has(suffixValue)) {
        
        // The purpose of the cache
        // is to store a sorted copy
        // of the suffix values.
        // This way we can control whether
        // we want to perform a greedy/non-greedy match
        if (!myCache.has(suffixValue)) {
            updateCache(suffixIndex, suffixValue, myCache);
        }

        let candidates = myCache.get(suffixValue);
        match = findMatch(candidates, suffix, longString, wordIndex, greedy);
        
        // If we find a matching word,
        // try to find the next matching word.
        // If next matching word is found, add
        // both the current word match and the
        // next matches
        let nextMatches = [];
        if (match !== null) {
            nextMatches = findViaPrefix([suffix[0] - match.length, suffix[1] - match.length], longString, wordIndex, suffixIndex, myCache);
            if (nextMatches.length > 0) {
                matches.push(match);
                matches = matches.concat(nextMatches);
            }
        }

        // if we cannot find the next word,
        // try a non-greedy search
        // as long as we haven't reached
        // the end of the longString
        if (match !== null
          && nextMatches.length  === 0
          && (suffix[1]+1) - match.length > 0) {
            //console.log('second attempt',longString[suffix[0] - match.length] + longString[suffix[1] - match.length], suffix, longString[suffix[0]] + longString[suffix[1]], match);
            match = findMatch(candidates, suffix, longString, wordIndex, false);
            if (match !== null) {
                matches.push(match);
                nextMatches = findViaPrefix([suffix[0] - match.length, suffix[1] - match.length], longString, wordIndex, suffixIndex, myCache);
                if (nextMatches.length > 0) {
                    matches = matches.concat(nextMatches);
                }
            }
        }

        // Handle the last word
        else if (match !== null
         && (suffix[1] + 1) - match.length === 0) {
            matches.push(match);
        }
    }

    // No suffix found
    // Try to find a one letter word match
    else {
        match =  findMatch([], suffix, longString, wordIndex);
        if (match !== null) {
            matches.push(match);
        }
    }

    return matches;
}


function updateCache(suffixIndex, suffixValue, myCache) {
    let sorted = suffixIndex.get(suffixValue);
    sorted.sort((val1, val2) => {
        if (val1.length === val2.length) {return 0}
        else if (val1.length > val2.length) {return -1}
        else {return 1}
    });
    myCache.set(suffixValue, sorted);
}

function findMatch(candidates, suffix, longString, wordIndex, greedy) {
    let total = candidates.length;
    let match = null;
    if (greedy) {
        for (let x=0; x<total; x++) {
            if (candidates[x].length > suffix[1] + 1) {continue;}
            if (candidates[x] === longString.slice(suffix[1]+1 - candidates[x].length, suffix[1]+1)) {
                match = candidates[x];
                break;
            }
        }
    }
    else {
        if (wordIndex.has(longString[suffix[1]])) {
            match = longString[suffix[1]];
        }
        else {
            for (let x=total-1; x>=0; x--) {
                if (candidates[x].length > suffix[1] + 1) {continue;}
                if (candidates[x] === longString.slice(suffix[1]+1 - candidates[x].length, suffix[1]+1)) {
                    match = candidates[x];
                    break;
                }
            }
        }
    }
    if (match === null
      && wordIndex.has(longString[suffix[1]])) {
        match = longString[suffix[1]];
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
    ,'doyoulikesomeramen'
    ,'goforgold'
    ,'mycuddlypersonalityisanendearingtrait'
    ,'iamallforkeepinghopealive'
    ,'ilikerice'
    ,'myfavoritepetisadog'
    ,'mymainconcernisthelackofpowerpuffgirlstoysinthelocalgrocerystore'
    ,'abcdefg'
    ,'abcdefgbark'
    ,'abcdefgbarkabcde'
    ,'ilikephotographyabcofficedepotcoffeecupgalore'
], __dirname + '/words_alpha.txt');
