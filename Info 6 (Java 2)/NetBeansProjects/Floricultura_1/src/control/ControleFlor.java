package control;

import java.util.ArrayList;
import model.Flor;
import model.Modelagem;

public class ControleFlor extends Controle {
    ArrayList<Flor> flores = new ArrayList();

    public ControleFlor() {
        this.setM(flores);
    }

    @Override
    public void editar(Modelagem p1) {}

    @Override
    public Modelagem nulo() {
        return new Flor("", "", 0);
    }
    

}