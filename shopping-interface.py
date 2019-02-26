# -*- coding: utf-8 -*-
 
from tkinter import * 

def alert():
	str_1 = ''
	fenetre_1 = Tk()
	fenetre_1.title('Ajouter un article')
	label = Label(fenetre_1, text="Code EAN")
	label.pack()

	value = StringVar() 
	value.set("Code EAN")
	entree = Entry(fenetre_1, textvariable=str_1, width=30)
	entree.pack()

fenetre = Tk()
fenetre.title('Shopping')

label = Label(fenetre, text="Shopping")
label.pack()

menubar = Menu(fenetre)

menu1 = Menu(menubar, tearoff=0)
menubar.add_cascade(label="Actions", menu=menu1)

menu1.add_command(label="Ajouter un article", command=alert)
menu1.add_separator()
menu1.add_command(label="Imprimer la liste", command=alert)
menu1.add_command(label="Vider la liste", command=alert)
menu1.add_separator()
menu1.add_command(label="Quitter", command=fenetre.quit)


fenetre.config(menu=menubar)


string=''

value = StringVar() 
value.set("texte par défaut")
entree = Entry(fenetre, textvariable=string, width=30)
entree.pack()

fenetre.mainloop()
