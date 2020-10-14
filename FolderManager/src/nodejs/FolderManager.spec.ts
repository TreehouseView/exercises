'use strict';

import sut from './FolderManager';

describe('Folder Manager', () => {
    const obj = new sut();
    it('Should run app', () => {
        obj.create('fruits');
        obj.create('vegetables');
        obj.create('grains');
        obj.create('fruits/apples');
        obj.create('fruits/apples/fuji');
        obj.create('grains/squash');
        obj.move('grains/squash', 'vegetables');
        obj.create('foods');
        obj.move('grains', 'foods');
        obj.move('fruits', 'foods');
        obj.move('vegetables', 'foods');
        obj.delete('fruits/apples');
        obj.delete('foods/fruits/apples');
        obj.list();
    })
});
