<?php

/* add.tpl */
class __TwigTemplate_d7661a79d9b9deb985bf703fa354e17f2c7add1d6f8ba8eca41d06b761228d5c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.tpl");

        $this->blocks = array(
            'pageContent' => array($this, 'block_pageContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.tpl";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["pageTitle"] = "Contacten toevoegen";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_pageContent($context, array $blocks = array())
    {
        // line 7
        echo "    <div id=\"filters\">
        <p>Via onderstaand formulier kan je een nieuw contact toevoegen</p>
    </div>

    ";
        // line 11
        if ((isset($context["errors"]) ? $context["errors"] : null)) {
            // line 12
            echo "        <div class=\"box\" id=\"boxError\">
            <p>Het formulier bevat fouten:</p>
            <ul class=\"errors\">
                ";
            // line 15
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 16
                echo "                    <li>";
                echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "            </ul>
        </div>
    ";
        }
        // line 21
        echo "    <div id=\"content\" class=\"clearfix\">
        <form action=\"add.php\" enctype=\"multipart/form-data\" method=\"post\">
            <dl>
                <dt><label for=\"name\">Naam: </label></dt>
                <dd><input type=\"text\" name=\"name\" id=\"name\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "name"), "html", null, true);
        echo "\"></dd>
                <dt><label for=\"name\" >E-mailadres: </label></dt>
                <dd><input type=\"text\" name=\"email\" id=\"email\" value=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "email"), "html", null, true);
        echo "\"></dd>
                <dt><label for=\"picture\">Foto (optioneel): </label></dt>
                <dd><input type=\"file\" name=\"picture\" id=\"picture\"></dd>
                <dt><label>Aard van het contact:</label></dt>
                <dd>
                    <label><input type=\"radio\" name=\"role\" id=\"role_family\" value=\"family\" /> familie</label>
                    <label><input type=\"radio\" name=\"role\" id=\"role_friend\" value=\"friend\" /> vriend</label>
                    <label><input type=\"radio\" name=\"role\" id=\"role_colleague\" value=\"colleague\" /> collega</label>
                    <label><input type=\"radio\" name=\"role\" id=\"role_other\" value=\"other\" /> andere</label>
                </dd>
                <dt><label for=\"comments\">Opmerkingen (optioneel): </label></dt>
                <dd><textarea rows=\"5\" cols=\"40\" name=\"comments\" id=\"comments\">";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["contact"]) ? $context["contact"] : null), "comments"), "html", null, true);
        echo "</textarea></dd>
                <dt class=\"full clearfix\" id=\"lastrow\">
                    <input type=\"submit\" id=\"btnOk\" name=\"btnOk\" value=\"Toevoegen\">
                    <input type=\"submit\" id=\"btnCancel\" name=\"btnCancel\" value=\"Annuleren\">
                </dt>
            </dl>
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "add.tpl";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 38,  75 => 27,  70 => 25,  64 => 21,  59 => 18,  50 => 16,  46 => 15,  41 => 12,  39 => 11,  33 => 7,  30 => 6,  25 => 3,);
    }
}
