'use strict';

class FolderNode {
    private name: string;

    /**
     * Chose Array instead of Map
     * for the exercise.
     *
     * Might be good to create
     * a version using Map
     */
    private children: Array<FolderNode>;

    constructor(folderName: string, children: Array<FolderNode> = []) {
        this.name = folderName;
        this.children = children;
    }

    create(folder: FolderNode): FolderNode {
        const index = this.findChildIndex(folder.folderName);
        if (index == undefined) {
            this.children.push(folder);
            return folder;
        }
        else {
            return this.children[index];
        }
    }

    /**
     * Return the index position of the child folder matching
     * the folder provided.
     *
     * Only performs a search on the folder's own children
     */
    findChildIndex(folder: string): number|undefined {
        for (let x = 0; x < this.children.length; x++) {
            if (this.children[x].folderName == folder) {
                return x;
            }
        }
        return undefined;
    }

    get folderName() {
        return this.name;
    }

    get childNodes() {
        return this.children;
    }

    /**
     * Recursively finds a child node
     * matching folder name provided
     */
    findChildNode(folder: Array<string>): FolderNode|undefined {
        const folderToFind = folder[0];
        let index = undefined;
        if (folderToFind) {
            index = this.findChildIndex(folderToFind);
        }
        if (index !== undefined) {
            if (folder.length > 1) {
                return this.children[index].findChildNode(folder
                    .filter((value, key) => {
                        return key !== 0;
                    })
                );
            }
            return this.children[index];
        }
        return undefined;
    }

    list(padding: string = '') {
        console.log(padding + this.name);
        this.children.forEach((node) => {
            node.list(padding + '-');
        });
    }

    move(src: Array<string>, dest: Array<string>): boolean {
        
        const srcNode = this.findChildNode(src);
        const destNode = this.findChildNode(dest);
        if (srcNode && destNode) {
            destNode.create(srcNode);
            this.delete(src);
            return true;
        }
        return false;
    }

    delete(folder: Array<string>): boolean {
        if (folder.length == 0) {
            return false;
        }
        let parentFolder: FolderNode|undefined = this;
        const childToRemove = folder[folder.length - 1];
        if (folder.length > 1) {
            parentFolder = this.findChildNode(folder
                .filter((value, key) => {
                    return key !== folder.length - 1;
                })
            );
        }

        // Here we are creating a copy of the children
        // excluding the node we want to delete.
        // Not a very efficient solution if we're dealing
        // with a large folder tree.
        //
        // This is where a map would shine because
        // we would have the ability to remove child
        // nodes easily and efficiently
        const newChildren: Array<FolderNode> = [];
        parentFolder?.children.forEach((node) => {
            if (node.folderName !== childToRemove) {
                newChildren.push(node);
            }
        });
        if (parentFolder && parentFolder.children?.length > newChildren.length) {
            parentFolder.children = newChildren;
            return true;
        }
        return false;
    }
}

export default class FolderManager {
    private root: FolderNode;

    constructor(folder: FolderNode = new FolderNode('root')) {
        this.root = folder;
    }

    /**
     * Create the child folder requested.
     * If the folder has parent folders that do not
     * exist, they will be created.
     * 
     * Operates under the assumption that the
     * folder paths provided are absolute paths.
     * 
     * example:
     *   'foo' - create child folder "foo"
     *   'foo/bar' - create child folder "bar" inside "foo"
     *   'wx/yz' - create parent folder "wx" and child folder "yz"
     * 
     * @param folder (string)
     */
    create(folder: string): void {
        const foldersToAdd = folder.split('/');
        foldersToAdd.reduce((accumulator, value) => {
            return accumulator.create(new FolderNode(value));
        }, this.root);
        console.log(`Created folder ${folder}`);
    }

    /**
     * List all child folders
     */
    list(): void {
        this.root.list();
    }

    /**
     * Move src folder to dest folder.
     * Folder to move can be in any child level.
     * 
     * Operates under the assumption that the
     * folder paths provided are absolute paths.
     * 
     * @param src (string)
     * @param dest (string)
     */
    move(src: string, dest: string) {
        if (this.root.move(
            src.split('/')
            ,dest.split('/')
        )) {
            console.log(`Successfully moved ${src} to ${dest}`);
        }
        else {
            console.log(`Failed to move ${src} to ${dest}`);
        }
    }

    /**
     * Delete the requested folder.
     * Folder can be nth level deep as long
     * as the absolute path is provided.
     * 
     * @param folder (string)
     */
    delete(folder: string) {
        if (this.root.delete(folder.split('/'))) {
            console.log('Folder ' + folder + ' deleted');
        }
        else {
            console.log('Folder ' + folder + ' not deleted');
        }
    }
}
