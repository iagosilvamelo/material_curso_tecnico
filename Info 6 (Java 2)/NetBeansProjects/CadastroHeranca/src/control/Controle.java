package control;

import java.util.ArrayList;
import model.Modelagem;

public abstract class Controle {

    private int indice = 0;
    private ArrayList<Modelagem> m;

    public Controle(ArrayList<Modelagem> m) {
        this.m = m;
    }

    public void avanca_indice() {
        if (indice < (m.size() - 1)) {
            indice++;
        }
    }

    public void voltar_indice() {
        if (indice > 0) {
            indice--;
        }
    }

    public Modelagem exibir() {
        Modelagem p;
        try {
            p = m.get(indice);
        } catch (Exception e) {
            p = nulo();
        }

        return p;
    }

    public void cadastrar(Modelagem p1) {
        m.add(p1);
    }

    public void excluir() {
        try {
            m.remove(indice);
        } catch (Exception e) {

        }
    }

    public abstract void editar(Modelagem p1);

    public abstract Modelagem nulo();
}