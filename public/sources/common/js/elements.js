/*
    This script file is used to manipulate html content, load content dynamically and
    Perform
*/

class Elements {
    elementPropertySetter(Me, myData) {
        if (myData == undefined) return;
        for (let key in myData) {
            if (myData[key] == null) continue;
            if (key == "text")
                Me.innerText = myData[key];
            else if (key == "html")
                Me.innerHTML = myData[key];
            else if (key == "child") {
                let child = myData[key];
                if (Array.isArray(child))
                    child.forEach(c => Me.appendChild(c));
                else
                    Me.appendChild(child);
            }
            else if (key == "event") {
                let events = myData[key];

                for (let event in events) {
                    Me[event] = () => events[event](Me);
                }
            }
            else
                Me.setAttribute(key, myData[key]);
        }
    }
    addElement(parent, me, myData) {
        let Me = document.createElement(me);
        this.elementPropertySetter(Me, myData);

        parent.appendChild(Me);
    }
    modifyElement(Me, myData) {
        this.elementPropertySetter(Me, myData);
        return Me;
    }
    createChild(me, myData) {
        let Me = document.createElement(me);
        this.elementPropertySetter(Me, myData);

        return Me;
    }

    buttonStartLoader(button) {
        if(button instanceof HTMLButtonElement)
            button.classList.toggle("embed-loader-icon", true);
        else if(button instanceof String)
            document.querySelector(button).classList.toString("embed-loader-icon", true);
    }
    buttonEndLoader(button) {
        if(button instanceof HTMLButtonElement)
            button.classList.toggle("embed-loader-icon", false);
        else if(button instanceof String)
            document.querySelector(button).classList.toString("embed-loader-icon", false);
    }
}



var elements = new Elements();

document.elements = elements;
document.createChild = elements.createChild;
document.addElement = elements.addElement;
document.modifyElement = elements.modifyElement;
document.startButtonLoader = elements.buttonStartLoader;
document.endButtonLoader = elements.buttonEndLoader;


class ProcessProgress {
     #baseStyleForProgress = `width:0px; max-width:100%; height:0.2em; 
                            max-height:0.2em; background-color:rgb(204, 102, 102); transition:width 0.3s ease-out; 
                            z-index:100000; position:fixed; top:0px; left:0px;`;

     constructor(host) {
        this.progressBar = elements.createChild("DIV", {style: this.#baseStyleForProgress});
        host.appendChild(this.progressBar);
     }

     setPercentage(percentage = 0) {
        if(percentage < 0 || percentage > 100)
            throw new Error("Invalid value for ProcessProgress.setPercentage()");

        this.progressBar.style.width = `${percentage}%`;
        if(percentage == 100) {
            setTimeout(() => {this.progressBar.style.display = 'none';
                this.progressBar.style.width = '0px';
            }, 50);
            setTimeout(() => {this.progressBar.style.display = 'block';},150);

        }
     }
}

var processProgress;

window.addEventListener('DOMContentLoaded', e => {
    processProgress = new ProcessProgress(document.body);

    /* set default action for navigation menu item click */
    [...document.querySelectorAll(".nav-menu > div > .menu > ul > li:has(ul)")].forEach(li => {
        li.addEventListener("mouseup", e => {
            li.classList.toggle("open");
        });
    });
    
    window.addEventListener("keydown", ev => {
        [...document.querySelectorAll("dialog")].forEach(d => {
            console.log(ev.key);
            if(ev.key == "Escape" ) {
                if(d.classList.contains("dialog-open")) {
                    d.classList.replace("dialog-open", "dialog-close");
                }
            }
        })
    });

    [...document.querySelectorAll("*[close-dialog]")].forEach(ev => {

        ev.addEventListener('click', c => {
            let tempDialog = null;
            if(ev.parentElement.tagName == "DIALOG")
                tempDialog = ev.parentElement;
            else if(ev.hasAttribute("dialog-id") && ev.getAttribute("dialog-id") != "") 
                tempDialog = document.getElementById(ev.getAttribute("dialog-id"));
    
            tempDialog.classList.toggle("dialog-open", false);
            tempDialog.classList.toggle("dialog-close", true);
            tempDialog.close();
        });
        
    });

    [...document.querySelectorAll(".dialog-overlay[for]")].forEach(el => {
        let tempDialog = document.getElementById(el.getAttribute('for'));
        if(tempDialog == null) return;
        if(tempDialog.hasAttribute("allow-ignore")){
            el.addEventListener('click', ev => {
                var event = new KeyboardEvent('keydown', {
                    key: 'Escape',
                    code: 'Escape',
                    keyCode: 27,
                    bubbles: true,
                    cancelable: true
                });
                
                document.dispatchEvent(event);
            });
        }
    });

    [...document.querySelectorAll("*[open-dialog]")].forEach(ev => {
        ev.addEventListener('click', c => {
            let tempDialog = null;
            if(ev.parentElement.tagName == "DIALOG")
                tempDialog = ev.parentElement;
            else if(ev.hasAttribute("dialog-id") && ev.getAttribute("dialog-id") != "") 
                tempDialog = document.getElementById(ev.getAttribute("dialog-id"));
    
            tempDialog.classList.toggle("dialog-open", true);
            tempDialog.classList.toggle("dialog-close", false);
            tempDialog.showModal();
            console.log("state changed");
        });
        
    });
});