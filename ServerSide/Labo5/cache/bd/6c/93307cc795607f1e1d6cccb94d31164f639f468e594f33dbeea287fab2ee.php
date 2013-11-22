<?php

/* browse.twig */
class __TwigTemplate_bd6c93307cc795607f1e1d6cccb94d31164f639f468e594f33dbeea287fab2ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.twig");

        $this->blocks = array(
            'javascript' => array($this, 'block_javascript'),
            'pageContent' => array($this, 'block_pageContent'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["pageTitle"] = "Browse Items";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_javascript($context, array $blocks = array())
    {
        // line 7
        echo "        <script src=\"js/browse.js\"></script>
    ";
    }

    // line 12
    public function block_pageContent($context, array $blocks = array())
    {
        // line 13
        echo "    ";
        // line 14
        echo "    <div class=\"box\" id=\"boxAddTodo\">
        <h2>Add new todo</h2>

        <div class=\"boxInner\">
            <form action=\"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["directTo"]) ? $context["directTo"] : null), "html", null, true);
        echo "\" method=\"post\">
                <fieldset>
                    <dl class=\"clearfix columns\">
                        <dd class=\"column column-46\"><input type=\"text\" name=\"what\" id=\"what\" value=\"\" /></dd>
                        <dd class=\"column column-16\" id=\"col-priority\">
                            <select name=\"priority\" id=\"priority\">
                                ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["priorities"]) ? $context["priorities"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["prior"]) {
            // line 25
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, (isset($context["prior"]) ? $context["prior"] : null), "html", null, true);
            echo "\"
                                            ";
            // line 26
            if (((isset($context["prior"]) ? $context["prior"] : null) == $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "priority"))) {
                // line 27
                echo "                                                selected
                                            ";
            }
            // line 29
            echo "                                            >";
            echo twig_escape_filter($this->env, (isset($context["prior"]) ? $context["prior"] : null), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['prior'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "                            </select>
                        </dd>
                        <dd class=\"column column-16\" id=\"col-submit\">
                            <label for=\"btnSubmit\"><input type=\"submit\" id=\"btnSubmit\" name=\"btnSubmit\" value=\"Add\" /></label>
                            <input type=\"hidden\" name=\"moduleAction\" id=\"moduleAction\" value=\"add\" />
                        </dd>
                    </dl>
                </fieldset>
            </form>
        </div>
    </div>

    ";
        // line 44
        echo "
    <h2>Your todos</h2>
    <div class=\"boxInner\">
        <ul>
            ";
        // line 48
        if ((isset($context["items"]) ? $context["items"] : null)) {
            // line 49
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["items"]) ? $context["items"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 50
                echo "
                    <li id=\"";
                // line 51
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id"), "html", null, true);
                echo "\" class=\"item ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "priority"), "html", null, true);
                echo " clearfix\">
                        <a href=\"delete.php?id=";
                // line 52
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id"), "html", null, true);
                echo "\" class=\"delete\" title=\"Delete/Complete this item\">delete/complete</a>
                        <a href=\"edit.php?id=";
                // line 53
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "id"), "html", null, true);
                echo "\" class=\"edit\" title=\"Edit this item\">edit</a>
                        <span>";
                // line 54
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["item"]) ? $context["item"] : null), "what"), "html", null, true);
                echo "</span>
                    </li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "
            ";
        } else {
            // line 59
            echo "                <li>No items to show</li>

            ";
        }
        // line 62
        echo "        </ul>
    </div>

    ";
        // line 66
        echo "    ";
        if ((isset($context["errors"]) ? $context["errors"] : null)) {
            // line 67
            echo "        <div class=\"box\" id=\"boxError\">
            <ul class=\"errors\">
                ";
            // line 69
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 70
                echo "                    <li>";
                echo twig_escape_filter($this->env, (isset($context["error"]) ? $context["error"] : null), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "            </ul>
        </div>
    ";
        }
    }

    public function getTemplateName()
    {
        return "browse.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 72,  161 => 70,  157 => 69,  153 => 67,  150 => 66,  145 => 62,  140 => 59,  136 => 57,  127 => 54,  123 => 53,  119 => 52,  113 => 51,  110 => 50,  105 => 49,  103 => 48,  97 => 44,  83 => 31,  74 => 29,  70 => 27,  68 => 26,  63 => 25,  59 => 24,  50 => 18,  44 => 14,  42 => 13,  39 => 12,  34 => 7,  31 => 6,  26 => 3,);
    }
}
